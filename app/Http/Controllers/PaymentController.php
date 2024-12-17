<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // List all payments
    public function index($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Get the bookable model (Event, Movie, etc.)
        $bookableModel = app($booking->bookable_type)::findOrFail($booking->bookable_id);

        // Fetch the price from the bookable model
        $totalAmount = $booking->seats_booked * $bookableModel->ticket_price;

        return view('payments.index', compact('booking', 'totalAmount', 'bookingId'));
    }
    // Accept payment method
    public function accept($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->status = 'completed'; // Update status to 'completed'
        $payment->save();

        $booking = $payment->booking; // Assuming there's a relationship defined between Payment and Booking
        $booking->payment_status = 'paid';
        $booking->save();
        
        Ticket::create([
            'user_id' => $booking->user_id,
            'ticketable_type' => $booking->bookable_type, // Polymorphic relationship
            'ticketable_id' => $booking->bookable_id,
            'price' => $booking->total_price,
            'quantity' => $booking->seats_booked,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Payment has been accepted.');
    }



    public function reject($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->status = 'failed'; // Update status to 'failed'
        $payment->save();

        return redirect()->route('bookings.index')->with('success', 'Payment has been rejected.');
    }





    public function process(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Process the payment with status 'pending'
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'payment_method' => $request->payment_method,
            'status' => 'pending',  // Set status to pending initially
        ]);



        // Update booking payment status to 'pending'
        $booking->update(['payment_status' => 'pending']);

        return redirect()->route('user.ticket', ['bookingId' => $booking->id])
            ->with('success', 'Payment initiated, awaiting admin approval!');
    }



    // Show details of a specific payment
    public function show($id)
    {
        $payment = Payment::with('booking')->findOrFail($id);

        return response()->json($payment);
    }

    // Create a new payment
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string',
            'status' => 'required|in:pending,completed,failed',
        ]);

        $payment = Payment::create([
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'method' => $request->method,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Payment created successfully',
            'payment' => $payment,
        ], 201);
    }

    // Update an existing payment
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'method' => 'sometimes|string',
            'status' => 'sometimes|in:pending,completed,failed',
        ]);

        $payment->update($request->only(['amount', 'method', 'status']));

        return response()->json([
            'message' => 'Payment updated successfully',
            'payment' => $payment,
        ]);
    }

    // Delete a payment
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
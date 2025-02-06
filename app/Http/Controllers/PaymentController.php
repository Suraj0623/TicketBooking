<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // List all payments for a specific booking
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
    // Accept payment method (POST)
    


    // Process the payment (e.g., initiate payment)
    public function process(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
        ]);

        // Find the booking and create a pending payment
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

    // Create a new payment (for administrative purposes)
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string',
            'status' => 'required|in:pending,completed,failed',
        ]);

        // Create the payment record
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

    // Update an existing payment (e.g., modify payment status or details)
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'method' => 'sometimes|string',
            'status' => 'sometimes|in:pending,completed,failed',
        ]);

        // Update the payment details
        $payment->update($request->only(['amount', 'method', 'status']));

        return response()->json([
            'message' => 'Payment updated successfully',
            'payment' => $payment,
        ]);
    }

    // Delete a payment (e.g., cancel or remove a payment)
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}

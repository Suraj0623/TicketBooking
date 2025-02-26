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

    // Find the booking
    $booking = Booking::findOrFail($request->booking_id);

    // Process the payment
    $payment = Payment::create([
        'booking_id' => $booking->id,
        'amount' => $booking->total_price,
        'payment_method' => $request->payment_method,
        'status' => $request->payment_method === 'pay_now' ? 'completed' : 'pending', // Set status based on payment method
    ]);

    // Update booking payment status
    $booking->update(['payment_status' => $request->payment_method === 'pay_now' ? 'paid' : 'pending']);

    // If payment method is 'pay_now', generate a ticket
    if ($request->payment_method === 'pay_now') {
        Ticket::create([
            'user_id' => $booking->user_id,
            'ticketable_type' => $booking->bookable_type,
            'ticketable_id' => $booking->bookable_id,
            'price' => $booking->total_price,
            'quantity' => $booking->seats_booked,
        ]);
    }

    return redirect()->route('tickets.index')
        ->with('success', 'Payment completed successfully! Your ticket has been generated.');
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

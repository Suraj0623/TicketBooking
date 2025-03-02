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
    public function index($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Get the bookable model (Event, Movie, etc.)
        $bookableModel = app($booking->bookable_type)::findOrFail($booking->bookable_id);

        // Fetch the price from the bookable model
        $totalAmount = $booking->seats_booked * $bookableModel->ticket_price;

        return view('payments.index', compact('booking', 'totalAmount', 'bookingId'));
    }
    public function updateStatus(Request $request, $paymentId)
{
    $payment = Payment::find($paymentId);

    if (!$payment || $payment->status !== 'pending') {
        return back()->with('error', 'Invalid payment or already completed.');
    }

    // Update payment status
    $payment->status = 'completed';
    $payment->save();

    // Check if booking was already accepted, then generate ticket
    $booking = $payment->booking;
    if ($booking && $booking->status === 'accepted') {
        Ticket::create([
            'user_id' => $booking->user_id,
            'event_id' => $booking->event_id,
            'booking_id' => $booking->id,
            'seat_number' => $booking->seat_number,
            'status' => 'generated'
        ]);
    }

    return redirect()->route('ticket.index')->with('success', 'Payment completed and ticket generated.');
}


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
    
        return redirect()->route('ticket.index')
            ->with('success', 'Payment completed successfully! Your ticket has been generated.');
    }

    public function updatePaymentStatus(Request $request, $paymentId)
    {
        $payment = Payment::find($paymentId);
    
        if (!$payment || $payment->status !== 'pending') {
            return back()->with('error', 'Invalid payment or already completed.');
        }
    
        // Update payment status to completed
        $payment->status = 'completed';
        $payment->save();
    
        // Find the associated booking
        $booking = $payment->booking;
    
        if ($booking) {
            // Update the booking status to 'accepted' after payment completion
            $booking->status = 'accepted';
            $booking->save();
    
            // Generate ticket after booking is accepted
            Ticket::create([
                'user_id' => $booking->user_id,
                'event_id' => $booking->event_id,
                'booking_id' => $booking->id,
                'seat_number' => $booking->seat_number,  // Ensure seat number logic is handled
                'status' => 'generated',
            ]);
        }
    
        return redirect()->route('ticket.index')->with('success', 'Payment completed, booking accepted, and ticket generated.');
    }
    
}

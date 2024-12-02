<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets for the authenticated user.
     */
    public function index()
    {
        $bookings = Booking::where('payment_status', 'paid')
            ->where('user_id', Auth::id())
            ->get();
    
        $tickets = Ticket::whereIn('ticketable_id', $bookings->pluck('bookable_id'))
            ->whereIn('ticketable_type', $bookings->pluck('bookable_type'))
            ->where('user_id', Auth::id())
            ->get();
    
        return view('tickets.index', compact('tickets'));
    }
    


    


    /**
     * Show the form for creating a new ticket (triggered after payment).
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created ticket in storage (triggered by completed payment).
     */
    public function store(Request $request)
    {
        // Get the booking based on the provided booking ID
        $booking = Booking::where('user_id', auth::id())
                          ->where('id', $request->booking_id)
                          ->firstOrFail();
    
        // Check if the payment status is completed
        $payment = Payment::where('booking_id', $booking->id)
                          ->where('status', 'completed')
                          ->first();
    
        if (!$payment) {
            return back()->withErrors(['payment' => 'Payment is not completed yet.']);
        }
    
        // Generate the ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'ticketable_type' => $booking->bookable_type,  // Use polymorphic relationship
            'ticketable_id' => $booking->bookable_id,
            'price' => $booking->total_price,
            'quantity' => $booking->seats_booked,
        ]);
    
        // Redirect with success message
        return redirect()->route('tickets.index')->with('success', 'Ticket generated successfully.');
    }
    


    /**
     * Display the specified ticket.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified ticket.
     */
    public function edit(Ticket $ticket)
    {
        
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Handle ticket update (if necessary).
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return back()->with('success', 'Ticket deleted successfully.');
    }
}

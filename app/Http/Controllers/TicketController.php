<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Ticket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets for the authenticated user.
     */
    public function index()
    {
        // Fetch tickets directly associated with the authenticated user
        $tickets = Ticket::where('user_id', Auth::id())
            ->with(['booking.bookable']) // Eager load the booking and its bookable relationship
            ->get();
    
        // Fetch paid bookings for the authenticated user
        $bookings = Booking::where('user_id', Auth::id())
            ->where('payment_status', 'paid')
            ->get();
    
        // Fetch tickets related to these bookings (scoped to the authenticated user)
        $ticketBookings = Ticket::where('user_id', Auth::id())
            ->whereIn('ticketable_id', $bookings->pluck('bookable_id'))
            ->whereIn('ticketable_type', $bookings->pluck('bookable_type'))
            ->with(['booking.bookable']) // Eager load the booking and its bookable relationship
            ->get();
    
        // Merge tickets from direct association and those from bookings
        $allTickets = $tickets->merge($ticketBookings);
    
        return view('tickets.index', compact('allTickets'));
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

    }



    /**
     * Display the specified ticket.
     */
    public function show($bookingId)
    {
        // Find the booking by ID
        $booking = Booking::with(['tickets'])->findOrFail($bookingId);
    
        // Get the first ticket associated with the booking
        $ticket = $booking->tickets->first();
    
        if (!$ticket) {
            return redirect()->route('tickets.index')->with('error', 'No ticket found for this booking.');
        }
    
        // Generate QR code data
        $qrCodeData = route('ticket.validate', ['ticket' => $ticket->id]);
    
        return view('tickets.show', compact('ticket', 'qrCodeData'));
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

public function validateTicket(Ticket $ticket)
{
    // Ensure the ticket belongs to the authenticated user
    if ($ticket->user_id !== auth::id()) {
        return response()->json(['status' => 'unauthorized', 'message' => 'This ticket does not belong to you.'], 403);
    }

    // Check if the ticket has already been used
    if ($ticket->status === 'used') {
        return response()->json(['status' => 'invalid', 'message' => 'This ticket has already been used.']);
    }

    // Mark the ticket as used
    $ticket->status = 'used';
    $ticket->save();

    return response()->json(['status' => 'valid', 'message' => 'Ticket validated successfully.']);
}
}

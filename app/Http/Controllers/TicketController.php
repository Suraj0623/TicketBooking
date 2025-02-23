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

        $tickets = auth::user()->tickets;
        $bookings = Booking::where('user_id', Auth::id())
            ->where('payment_status', 'paid')
            ->get();

        // Fetch tickets related to these bookings
        $ticketBookings = Ticket::whereIn('ticketable_id', $bookings->pluck('bookable_id'))
            ->whereIn('ticketable_type', $bookings->pluck('bookable_type'))
            ->get();

        // Merge tickets from user's direct relationship and those from bookings
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
    public function show($ticketId)
    {
        $ticket = Ticket::with(['ticketable', 'seats'])->find($ticketId);

        if (!$ticket) {
            // If the ticket is not found, redirect to an error page or handle accordingly
            return redirect()->route('tickets.index')->with('error', 'Ticket not found');
        }

        // Generate QR code data (e.g., ticket ID or user ID)
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
            return response()->json(['status' => 'unauthorized'], 403);
        }

        // Check if the ticket has already been used
        if ($ticket->status === 'used') {
            return response()->json(['status' => 'invalid']);
        }

        // Mark the ticket as used
        $ticket->status = 'used';
        $ticket->save();

        return response()->json(['status' => 'valid']);
    }

}

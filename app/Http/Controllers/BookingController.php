<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'bookable')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
       
        $bookableId = $request->input('bookable_id');
        $bookableType = $request->input('bookable_type');
        $bookableModel = app($bookableType)::find($bookableId);
        if (!$bookableId || !$bookableType) {
            return back()->withErrors(['error' => 'Invalid booking details.']);
        }
    
        $seat = Seat::where('seatable_id', $bookableId)
            ->where('seatable_type', $bookableType)
            ->first();
    
        if (!$seat) {
            return back()->withErrors(['error' => 'Seat information not found.']);
        }
    
        $availableSeats = $seat->available_seats;
        $pricePerSeat = $bookableModel->ticket_price;
    
        return view('bookings.create', compact('bookableId', 'bookableType', 'availableSeats', 'pricePerSeat'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'seats_booked' => 'required|integer|min:1',
            'payment_option' => 'required|string',
        ]);

        // Check if the selected number of seats are available
        $seat = Seat::where('seatable_id', $request->bookable_id)
            ->where('seatable_type', $request->bookable_type)
            ->first();

        if ($request->seats_booked > $seat->available_seats) {
            return back()->withErrors(['seats_booked' => 'Not enough available seats.']);
        }

        // Fetch the bookable model (e.g., Event, Movie, etc.) to get the price per seat
        $bookableModel = app($request->bookable_type)::findOrFail($request->bookable_id);
        $pricePerSeat = $bookableModel->ticket_price;

        // Calculate total price based on the seats booked and the price per seat
        $totalPrice = $pricePerSeat * $request->seats_booked;

        // If the user chooses 'Pay Later', redirect back to the form
        if ($request->payment_option === 'pay_later') {
            return back()
                ->withInput()
                ->with('message', 'Booking cannot proceed with Pay Later. Please choose Pay Now.');
        }

        // Create the booking
        $booking = Booking::create([
            'user_id' => auth::id(),
            'bookable_id' => $request->bookable_id,
            'bookable_type' => $request->bookable_type,
            'seats_booked' => $request->seats_booked,
            'total_price' => $totalPrice,  // Store the calculated total price
            'payment_status' => 'pending',
        ]);

        // Update available seats
        $seat->update([
            'available_seats' => $seat->available_seats - $request->seats_booked,
        ]);

        return redirect()->route('payment.index', ['booking_id' => $booking->id]);
    }


   


    

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403,'Unauthorized');
        }
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( string $id, Request $request)
    {
        $booking=Booking::findOrFail($id);
        $seat=Seat::where('seatable_id',$request->bookable_id)
        ->where('seatable_type',$request->bookable_type)->first();
        $seat->update(['available_seats'=>$seat->available_seats+ $booking->seats_booked]);
        $booking->delete();

        return response()->json(['message'=>'booking cancelled and seats restored']); 

        
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking canceled successfully');
    }

// Dynamic Status Update
    public function updateStatus(Request $request, Booking $booking)
{
    $request->validate(['status' => 'required|string']);
    $booking->update(['status' => $request->status]);
    return response()->json(['success' => true, 'message' => 'Status updated successfully']);
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function manageSeats(Request $request, $id, $type)
    {
        $seat = Seat::where('seatable_id', $id)
            ->where('seatable_type', $type)
            ->first();

        return view('seats.manage', compact('seat', 'type'));
    }

    public function updateSeats(Request $request, $id, $type)
    {
        $request->validate([
            'total_seats' => 'required|integer|min:1',
        ]);

        $seat = Seat::where('seatable_id', $id)
            ->where('seatable_type', $type)
            ->first();

        $seat->update([
            'total_seats' => $request->total_seats,
            'available_seats' => $seat->available_seats + ($request->total_seats - $seat->total_seats),
        ]);

        return back()->with('success', 'Seats updated successfully.');
    }

    public function view(Booking $booking)
{
    // Retrieve the seatable item (polymorphic relation) and its seats
    $seatable = $booking->bookable; // e.g., event, movie, etc.
    $seats = $seatable->seats; // Assuming the seatable relationship is defined

    return view('seats.view', [
        'booking' => $booking,
        'seatable' => $seatable,
        'seats' => $seats,
    ]);
}

    
public function assignSeats(Request $request)
{
    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'seat_numbers' => 'required|array',
        'seat_numbers.*' => 'integer', // Validate each seat number
    ]);

    $booking = Booking::findOrFail($request->booking_id);
    $seatable = $booking->bookable;
    $assignedSeats = $request->seat_numbers;

    // Ensure the number of seats matches the booking
    if (count($assignedSeats) !== $booking->seats_booked) {
        return back()->withErrors('The number of assigned seats must match the booked seats.');
    }

    // Check availability
    $availableSeats = $seatable->seats()->where('is_booked', false)->pluck('id')->toArray();
    foreach ($assignedSeats as $seat) {
        if (!in_array($seat, $availableSeats)) {
            return back()->withErrors("Seat $seat is not available.");
        }
    }

    // Assign seats and update their status
    Seat::whereIn('id', $assignedSeats)->update(['is_booked' => true]);

    return redirect()->route('seats.view', $booking->id)
        ->with('success', 'Seats have been successfully assigned.');
}

}

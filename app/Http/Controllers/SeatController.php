<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Manage seat information for a specific bookable item (e.g., event, transportation).
     */
    public function manageSeats(Request $request, $id, $type)
    {
        $seats = Seat::where('seatable_id', $id)
            ->where('seatable_type', $type)
            ->get();

        return view('seats.manage', compact('seats', 'type'));
    }

    /**
     * Update the total and available seats for a bookable item.
     */
    public function updateSeats(Request $request, $id, $type)
    {
        $request->validate([
            'total_seats' => 'required|integer|min:1',
        ]);

        $existingSeats = Seat::where('seatable_id', $id)
            ->where('seatable_type', $type)
            ->get();

        $currentTotal = $existingSeats->count();
        $newTotal = $request->total_seats;

        if ($newTotal > $currentTotal) {
            // Add additional seats
            for ($i = $currentTotal + 1; $i <= $newTotal; $i++) {
                Seat::create([
                    'seatable_id' => $id,
                    'seatable_type' => $type,
                    'seat_number' => 'S' . $i,
                    'status' => 'available',
                ]);
            }
        } elseif ($newTotal < $currentTotal) {
            // Remove excess available seats
            $seatsToRemove = $existingSeats->where('status', 'available')
                ->take($currentTotal - $newTotal);
            foreach ($seatsToRemove as $seat) {
                $seat->delete();
            }
        }

        return back()->with('success', 'Seats updated successfully.');
    }

    /**
     * View seat details for a specific booking.
     */
    public function view(Booking $booking)
    {
        $seatable = $booking->bookable;
        $seats = $seatable->seats; // Assuming a `morphMany` relationship on the bookable model

        // Calculate total and available seats
        $totalSeats = $seats->count();
        $availableSeats = $seats->where('status', 'available')->count();

        return view('seats.view', [
            'booking' => $booking,
            'seatable' => $seatable,
            'seats' => $seats,
            'totalSeats' => $totalSeats,
            'availableSeats' => $availableSeats,
        ]);
    }

    /**
     * Assign seats to a booking.
     */
    public function assignSeats(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'seat_numbers' => 'required|array',
            'seat_numbers.*' => 'string', // Validate seat numbers as strings
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $seatable = $booking->bookable;
        $assignedSeats = $request->seat_numbers;

        // Ensure the number of assigned seats matches the booked seats
        if (count($assignedSeats) !== $booking->seats_booked) {
            return back()->withErrors('The number of assigned seats must match the booked seats.');
        }

        // Check availability of the requested seats
        $availableSeats = $seatable->seats()
            ->where('status', 'available')
            ->pluck('seat_number')
            ->toArray();

        foreach ($assignedSeats as $seatNumber) {
            if (!in_array($seatNumber, $availableSeats)) {
                return back()->withErrors("Seat $seatNumber is not available.");
            }
        }

        // Assign seats and update their status
        Seat::whereIn('seat_number', $assignedSeats)
            ->update(['status' => 'booked', 'user_id' => $booking->user_id]);

        return redirect()->route('seats.view', $booking->id)
            ->with('success', 'Seats have been successfully assigned.');
    }
    public function update(Request $request,Seat $seat){
        $seat->update(['is_booked'=>$request->is_booked]);
        return response()->json(['success'=>true]);
    }
}

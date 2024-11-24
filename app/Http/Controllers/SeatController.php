<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function manageSeats(Request $request, $id, $type)
    {
        $seat = Seat::where('seatable_id', $id)
            ->where('seatable_type', $type)
            ->first();

        return view('seat.manage', compact('seat', 'type'));
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
}

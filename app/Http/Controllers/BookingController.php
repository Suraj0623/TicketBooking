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
        $bookings = Booking::with(['user', 'bookable', 'payment'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'bookable_id' => 'required|integer',
            'bookable_type' => 'required|string',
        ]);

        $bookableId = $request->bookable_id;
        $bookableType = $request->bookable_type;

        $bookableModel = app($bookableType)::find($bookableId);
        if (!$bookableModel) {
            return back()->withErrors(['error' => 'Invalid booking details.']);
        }

        $availableSeats = Seat::where('seatable_id', $bookableId)
            ->where('seatable_type', $bookableType)
            ->where('status', 'available')
            ->count();

        $pricePerSeat = $bookableModel->ticket_price;

        return view('bookings.create', compact('bookableId', 'bookableType', 'availableSeats', 'pricePerSeat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'seats_booked' => 'required|integer|min:1',
            'payment_option' => 'required|string|in:pay_now',
        ]);

        $bookableId = $request->bookable_id;
        $bookableType = $request->bookable_type;

        $seats = Seat::where('seatable_id', $bookableId)
            ->where('seatable_type', $bookableType)
            ->where('status', 'available')
            ->take($request->seats_booked)
            ->get();

        if ($seats->count() < $request->seats_booked) {
            return back()->withErrors(['seats_booked' => 'Not enough available seats.']);
        }

        $bookableModel = app($bookableType)::findOrFail($bookableId);
        $pricePerSeat = $bookableModel->ticket_price;
        $totalPrice = $pricePerSeat * $request->seats_booked;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'bookable_id' => $bookableId,
            'bookable_type' => $bookableType,
            'seats_booked' => $request->seats_booked,
            'total_price' => $totalPrice,
            'payment_status' => 'pending',
        ]);

        foreach ($seats as $seat) {
            $seat->update(['status' => 'booked', 'user_id' => Auth::id()]);
        }

        return redirect()->route('payment.index', ['booking_id' => $booking->id]);
    }

    public function update(string $id, Request $request)
    {
        $booking = Booking::findOrFail($id);

        // Restore seat availability
        $seats = Seat::where('seatable_id', $booking->bookable_id)
            ->where('seatable_type', $booking->bookable_type)
            ->where('user_id', $booking->user_id)
            ->get();

        foreach ($seats as $seat) {
            $seat->update(['status' => 'available', 'user_id' => null]);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking cancelled and seats restored']);
    }

    public function destroy(Booking $booking)
    {
        $this->update($booking->id, new Request());
        return redirect()->route('booking.index')->with('success', 'Booking canceled successfully');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|string']);
        $booking->update(['status' => $request->status]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
}

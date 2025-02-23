<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'payment_status' => 'pending', // Default payment status
        ]);

        foreach ($seats as $seat) {
            $seat->update(['status' => 'booked', 'user_id' => Auth::id()]);
        }

        return redirect()->route('payment.index', ['booking_id' => $booking->id]);
    }

    // Updated method for updating the booking details
    public function update(string $id, Request $request)
    {
        // Find the booking or fail if not found
        $booking = Booking::findOrFail($id);

        // Validate the request
        $request->validate([
            'seats_booked' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'payment_status' => 'required|string|in:pending,paid,failed', // Validate valid statuses
        ]);

        // Get the payment status from the request or default to 'pending'
        $paymentStatus = $request->input('payment_status', 'pending');

        // Update the booking details
        $booking->update([
            'seats_booked' => $request->seats_booked,
            'total_price' => $request->total_price,
            'payment_status' => $paymentStatus, // Update the payment status
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully');
    }

    // Renamed method to cancel the booking (previously `update`)
    public function cancel(string $id, Request $request)
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

    // The destroy method now uses the renamed cancel method
    public function destroy(Booking $booking)
    {
        $this->cancel($booking->id, new Request());
        return redirect()->route('booking.index')->with('success', 'Booking canceled successfully');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|string']);
        $booking->update(['status' => $request->status]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    // Edit method to render the form for editing a booking
    public function edit($id)
    {
        // Retrieve the booking details by ID
        $booking = Booking::with(['user', 'bookable', 'payment'])->findOrFail($id);

        // Return the view with the booking data to populate the form
        return view('bookings.edit', compact('booking'));
    }

    public function accept(string $id)
    {
        // Find the booking or fail if not found
        $booking = Booking::findOrFail($id);

        // Ensure the payment status is 'pending' before accepting
        if ($booking->payment_status !== 'pending') {
            return redirect()->route('booking.index')
                ->with('error', 'This payment has already been processed.');
        }

        // Update the payment status to 'paid'
        $booking->update(['payment_status' => 'paid']);

        // Redirect with success message
        return redirect()->route('booking.index')
            ->with('success', 'Booking payment accepted successfully.');
    }


    public function reject(string $id)
    {
        // Find the booking or fail if not found
        $booking = Booking::findOrFail($id);

        // Ensure the payment status is 'pending' before rejecting
        if ($booking->payment_status !== 'pending') {
            return redirect()->route('booking.index')
                ->with('error', 'This payment has already been processed.');
        }

        // Update the payment status to 'failed'
        $booking->update(['payment_status' => 'failed']);

        // Redirect with success message
        return redirect()->route('booking.index')
            ->with('success', 'Booking payment rejected successfully.');
    }

}

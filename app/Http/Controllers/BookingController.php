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
        $bookings = Booking::with(['user', 'bookable', 'payment'])->paginate(10);
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
            'payment_option' => 'required|string|in:pay_now,pay_later',
        ]);

        $bookableId = $request->bookable_id;
        $bookableType = $request->bookable_type;

        // Check available seats
        $seats = Seat::where('seatable_id', $bookableId)
            ->where('seatable_type', $bookableType)
            ->where('status', 'available')
            ->take($request->seats_booked)
            ->get();

        if ($seats->count() < $request->seats_booked) {
            return redirect()->back()->with('message', 'Not enough available seats.');
        }

        // Fetch bookable model and calculate total price
        $bookableModel = app($bookableType)::findOrFail($bookableId);
        $pricePerSeat = $bookableModel->ticket_price;
        $totalPrice = round($pricePerSeat * $request->seats_booked, 2);

        // Map payment_option to payment_status
        $paymentStatus = $request->payment_option === 'pay_now' ? 'paid' : 'pending';

        // Create the booking
        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'bookable_id' => $bookableId,
                'bookable_type' => $bookableType,
                'seats_booked' => $request->seats_booked,
                'total_price' => $totalPrice,
                'payment_status' => $paymentStatus,
            ]);

            // Update seat statuses
            foreach ($seats as $seat) {
                $seat->update(['status' => 'booked', 'user_id' => Auth::id()]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Booking failed: " . $e->getMessage());
            return redirect()->back()->with('error', 'Booking failed.');
        }

        return redirect()->route('payment.index', ['booking_id' => $booking->id]);
    }

    public function update(string $id, Request $request)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'seats_booked' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'payment_status' => 'required|string|in:pending,paid,failed',
        ]);

        if ($request->payment_status === 'paid') {
            return $this->markAsPaid($booking);
        }

        $booking->update([
            'seats_booked' => $request->seats_booked,
            'total_price' => $request->total_price,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully');
    }

    public function cancel(string $id, Request $request)
    {
        $booking = Booking::findOrFail($id);

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
        $this->cancel($booking->id, new Request());
        return redirect()->route('booking.index')->with('success', 'Booking canceled successfully');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|string']);

        if ($request->status === 'paid') {
            return $this->markAsPaid($booking);
        }

        $booking->update(['payment_status' => $request->status]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function edit($id)
    {
        $booking = Booking::with(['user', 'bookable', 'payment'])->findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function accept(string $id)
    {
        $booking = Booking::findOrFail($id);
        return $this->markAsPaid($booking);
    }

    public function reject(string $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->payment_status !== 'pending') {
            return redirect()->route('booking.index')
                ->with('error', 'This payment has already been processed.');
        }

        $booking->update(['payment_status' => 'failed']);

        return redirect()->route('booking.index')
            ->with('success', 'Booking payment rejected successfully.');
    }

    private function markAsPaid(Booking $booking)
    {
        if ($booking->payment_status === 'paid') {
            return redirect()->route('booking.index')
                ->with('error', 'This payment has already been processed.');
        }

        DB::beginTransaction();
        try {
            $booking->update(['payment_status' => 'paid']);

            Ticket::create([
                'user_id' => $booking->user_id,
                'ticketable_type' => $booking->bookable_type,
                'ticketable_id' => $booking->bookable_id,
                'price' => $booking->total_price,
                'quantity' => $booking->seats_booked,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Payment update failed: " . $e->getMessage());
            return redirect()->route('booking.index')->with('error', 'Payment update failed.');
        }

        return redirect()->route('booking.index')
            ->with('success', 'Booking payment accepted successfully.');
    }
}

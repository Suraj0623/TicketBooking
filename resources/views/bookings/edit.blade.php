@extends('layouts.admin')

@section('title', 'Edit Booking')

@section('content')
    <div class="container">
        <h1>Edit Booking</h1>

        <form action="{{ route('booking.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT method for updates -->

            <div class="form-group">
                <label for="seats_booked">Seats Booked</label>
                <input type="number" name="seats_booked" id="seats_booked" value="{{ old('seats_booked', $booking->seats_booked) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="number" name="total_price" id="total_price" value="{{ old('total_price', $booking->total_price) }}" class="form-control" required>
            </div>

            <!-- Add other fields as needed -->

            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
@endsection

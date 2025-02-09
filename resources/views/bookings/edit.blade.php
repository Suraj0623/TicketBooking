@extends('layouts.admin')

@section('title', 'Edit Booking')

@section('content')
    <div class="container">
        <h1>Edit Booking</h1>

        <!-- Display errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="seats_booked">Seats Booked</label>
                <input type="number" name="seats_booked" id="seats_booked" value="{{ old('seats_booked', $booking->seats_booked) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="number" name="total_price" id="total_price" value="{{ old('total_price', $booking->total_price) }}" class="form-control" required>
            </div>

            <!-- Payment Status Dropdown -->
            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-control" required>
                    <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
@endsection

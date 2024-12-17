@extends('layouts.admin')

@section('title', 'Seats Management')

@section('content')
    <div class="container">
        <h1>Seats for {{ $booking->bookable->title ?? $booking->bookable->name }}</h1>

        <div class="mb-4">
            <p><strong>Total Seats:</strong> {{ $seatable->total_seats }}</p>
            <p><strong>Available Seats:</strong> {{ $seatable->available_seats }}</p>
        </div>

        <form action="{{ route('seats.assign') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

            <div class="form-group">
                <label for="seat_numbers">Assign Seat Numbers</label>
                <input type="text" name="seat_numbers[]" class="form-control" placeholder="Enter seat numbers (comma separated)" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Assign Seats</button>
        </form>

        <h2 class="mt-5">Available Seats</h2>
        <ul>
            @foreach($seats->where('is_booked', false) as $seat)
                <li>Seat #{{ $seat->id }}</li>
            @endforeach
        </ul>

        <h2 class="mt-5">Booked Seats</h2>
        <ul>
            @foreach($seats->where('is_booked', true) as $seat)
                <li>Seat #{{ $seat->id }}</li>
            @endforeach
        </ul>
    </div>
@endsection

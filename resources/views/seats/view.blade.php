@extends('layouts.admin')

@section('title', 'Seats Management')

@section('content')
<div class="container">
    <h1>Seats for {{ $booking->bookable->title ?? $booking->bookable->name }}</h1>

    <div class="mb-4">
        <p><strong>Total Seats:</strong> {{ $totalSeats }}</p>
        <p><strong>Available Seats:</strong> {{ $availableSeats }}</p>
    </div>

    {{-- Assign Seats Form --}}
    <form action="{{ route('seats.assign') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <div class="form-group">
            <label for="seat_numbers">Assign Seat Numbers</label>
            <input 
                type="text" 
                name="seat_numbers[]" 
                class="form-control" 
                placeholder="Enter seat numbers (comma separated, e.g., A1,B2,C3)" 
                required
            >
        </div>
        <button type="submit" class="btn btn-primary mt-3">Assign Seats</button>
    </form>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- List of Available Seats --}}
    <h2 class="mt-5">Available Seats</h2>
    @if($seats->where('status', 'available')->count() > 0)
        <ul>
            @foreach($seats->where('status', 'available') as $seat)
                <li>Seat #{{ $seat->seat_number }}</li>
            @endforeach
        </ul>
    @else
        <p>No available seats.</p>
    @endif

    {{-- List of Booked Seats --}}
    <h2 class="mt-5">Booked Seats</h2>
    @if($seats->where('status', 'booked')->count() > 0)
        <ul>
            @foreach($seats->where('status', 'booked') as $seat)
                <li>Seat #{{ $seat->seat_number }} (Assigned to User ID: {{ $seat->user_id }})</li>
            @endforeach
        </ul>
    @else
        <p>No booked seats.</p>
    @endif
</div>
@endsection

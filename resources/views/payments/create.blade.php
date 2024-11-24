@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Initiate Payment for Booking #{{ $booking->id }}</h1>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Initiate Payment</button>
    </form>
</div>
@endsection
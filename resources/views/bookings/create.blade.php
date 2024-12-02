@extends('layouts.app')

@section('title', 'Book Now')

@section('content')
    <h1>Book Seats</h1>

    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        <input type="hidden" name="bookable_type" value="{{ old('bookable_type', $bookableType) }}">
        <input type="hidden" name="bookable_id" value="{{ old('bookable_id', $bookableId) }}">

        <p><strong>Total Seats Available:</strong> {{ $availableSeats }}</p>

        <div class="mb-3">
            <label for="seats_booked" class="form-label">Number of Seats:</label>
            <input type="number" class="form-control" id="seats_booked" name="seats_booked" 
                   min="1" max="{{ $availableSeats }}" value="{{ old('seats_booked', 1) }}" required>
        </div>

        <p><strong>Price per Seat:</strong> ${{ number_format($pricePerSeat, 2) }}</p>
        <p><strong>Total Price:</strong> <span id="total_price_display">${{ number_format(old('total_price', $pricePerSeat), 2) }}</span></p>
        <input type="hidden" id="total_price" name="total_price" value="{{ old('total_price', $pricePerSeat) }}">

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Option:</label>
            <select class="form-control" id="payment_method" name="payment_option" required>
                <option value="pay_now" {{ old('payment_option') == 'pay_now' ? 'selected' : '' }}>Pay Now</option>
                <option value="pay_later" {{ old('payment_option') == 'pay_later' ? 'selected' : '' }}>Pay Later</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Confirm Booking</button>
    </form>

    <script>
        const seatsInput = document.getElementById('seats_booked');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceInput = document.getElementById('total_price');
        const pricePerSeat = {{ $pricePerSeat }};

        seatsInput.addEventListener('input', () => {
            const total = seatsInput.value * pricePerSeat;
            totalPriceDisplay.textContent = `$${total.toFixed(2)}`;
            totalPriceInput.value = total.toFixed(2);
        });
    </script>
@endsection

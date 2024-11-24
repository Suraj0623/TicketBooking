@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <h1>Payment Details</h1>

    <p><strong>Total Amount:</strong> ${{ number_format($totalAmount, 2) }}</p>
    <form action="{{ route('payment.process') }}" method="POST">
        @csrf

        <input type="hidden" name="booking_id" value="{{ $bookingId }}">

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method:</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Make Payment</button>
    </form>
@endsection

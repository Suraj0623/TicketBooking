@extends('layouts.app')

@section('content')
    <h1>Payment {{ $payment->id }}</h1>

    <p>Booking ID: {{ $payment->booking_id }}</p>
    <p>Amount: {{ $payment->amount }}</p>
    <p>Status: {{ $payment->status }}</p>

    <a href="{{ route('payments.index') }}">Back to Payments</a>
@endsection
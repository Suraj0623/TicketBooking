@extends('layouts.app')

@section('title', 'My Ticket')

@section('content')
    <h1>Ticket Details</h1>

    @if($ticket->isEmpty())  <!-- Check if collection is empty -->
        <p>No tickets found.</p>
    @else
        @foreach($ticket as $t)  <!-- Loop through each ticket -->
            <div class="ticket-details">
                <p><strong>Title/Name:</strong> {{ $t->ticketable->title ?? $t->ticketable->name }}</p>
                <p><strong>Seats Booked:</strong> {{ $t->quantity }}</p>
                <p><strong>Total Price:</strong> ${{ number_format($t->price, 2) }}</p>
                <p><strong>Status:</strong> 
                    @if($t->booking->payment_status === 'paid')
                        <span class="text-success">Paid</span>
                    @else
                        <span class="text-warning">Pending</span>
                    @endif
                </p>
            </div>
        @endforeach
    @endif
@endsection

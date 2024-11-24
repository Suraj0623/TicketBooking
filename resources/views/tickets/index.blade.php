@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
    <h1>My Tickets</h1>

    @if($tickets->isEmpty())
        <p>You have no tickets.</p>
    @else
        <ul>
            @foreach($tickets as $ticket)
                <li>
                    <strong>{{ $ticket->ticketable->title }}</strong><br>
                    Seats Booked: {{ $ticket->quantity }}<br>
                    Total Price: ${{ number_format($ticket->price, 2) }}<br>
                    <a href="{{ route('tickets.show', $ticket) }}">View Details</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

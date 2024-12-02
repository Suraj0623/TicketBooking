@extends('layouts.search')
@section('title', 'Events')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4">Events</h1>

    <!-- Search Box -->
    <x-search-box search-route="{{ route('event.index') }}" placeholder="Search events..." />

    <div class="row mt-4">
        @foreach($events as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="card-text"><strong>Date:</strong> {{ $event->event_date }}</p>
                        <p class="card-text"><strong>Venue:</strong> {{ $event->venue }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $event->ticket_price }}</p>
                        <a href="{{ route('booking.create', ['bookable_id' => $event->id, 'bookable_type' => get_class($event)]) }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

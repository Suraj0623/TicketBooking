
<button class="btn btn-primary mb-3"> <a href="{{route('events.create')}}"> Add new Event</a></button>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<h1>Events</h1>
<div class="row">
    @foreach($events as $event)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ $event->description }}</p>
                    <p class="card-text"><strong>Date:</strong> {{ $event->event_date }}</p>
                    <p class="card-text"><strong>Venue:</strong> {{ $event->venue }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $event->ticket_price }}</p>
                    <a href="{{ route('booking.create') }}" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

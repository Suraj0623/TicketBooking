<button class="btn btn-primary mb-3">
    <a href="{{ route('events.create') }}" style="color: white; text-decoration: none;">Add New Event</a>
</button>
<button class="btn btn-primary mb-3">
    <a href="{{ route('dashboardPage') }}" style="color: white; text-decoration: none;">Admin Dashboard</a>
</button>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<h1>Events</h1>
<div class="row">
    @foreach ($events as $event)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ Str::limit($event->description, 50) }}</p>
                    <p class="card-text"><strong>Date:</strong> {{ $event->event_date }}</p>
                    <p class="card-text"><strong>Venue:</strong> {{ $event->venue }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $event->ticket_price }}</p>
                    <p class="card-text"><strong>Category:</strong> {{ $event->category }}</p> <!-- Add category -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
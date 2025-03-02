<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container card">
    <h6><strong>Screenings:</strong></h6>

</div>
<x-search-box search-route="{{ route('screening.index') }}" placeholder="Search movies..." />
@if (request('search'))
            <p class="text-center">Search results for: <strong>{{ request('search') }}</strong></p>
        @endif
@if($movie->screenings->count())
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($movie->screenings as $screening)
            <div class="col">
                <div class="card shadow-sm rounded-3 border-0">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $screening->cinema }}</h5>
                        <p class="card-text">
                            <strong>Show Time:</strong> {{ \Carbon\Carbon::parse($screening->show_time)->format('d M Y, h:i A') }}<br>
                            <strong>Price:</strong> ${{ $screening->ticket_price }}<br>
                            <strong>Total Seats:</strong> {{ $screening->total_seats }}<br>
                        </p>
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-success">{{ $screening->total_seats - $screening->booked_seats }} Seats Left</span>
                            <span class="badge bg-warning">{{ $screening->booked_seats }} Seats Booked</span>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <!-- Button with popover for booking -->
                        <button class="btn btn-primary" data-bs-toggle="popover" title="Book Seats" data-bs-content="Click here to book your seats for this screening!">
                            <a href="{{ route('booking.create', ['bookable_id' => $screening->id, 'bookable_type' => get_class($screening)]) }}" class="text-white text-decoration-none">
                                Book Now
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No screenings available for this movie yet.</p>
@endif

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <div class="card p-4 shadow-sm border-0 rounded-4">
        <h5 class="mb-3 text-primary"><strong>Screenings:</strong></h5>

        <x-search-box search-route="{{ route('screening.index') }}" placeholder="Search movies..." class="mb-3" />

        @if (request('search'))
            <p class="text-center fst-italic text-secondary">Search results for: <strong class="text-dark">{{ request('search') }}</strong></p>
        @endif

        @if($movie->screenings->count())
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($movie->screenings as $screening)
                    <div class="col">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold">{{ $screening->cinema }}</h5>
                                <p class="card-text text-muted">
                                    <strong class="text-dark">Show Time:</strong> 
                                    {{ \Carbon\Carbon::parse($screening->show_time)->format('d M Y, h:i A') }}<br>
                                    <strong class="text-dark">Price:</strong> ${{ $screening->ticket_price }}<br>
                                    <strong class="text-dark">Total Seats:</strong> {{ $screening->total_seats }}<br>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        {{ $screening->total_seats - $screening->booked_seats }} Seats Left
                                    </span>
                                    <span class="badge bg-warning px-3 py-2 rounded-pill">
                                        {{ $screening->booked_seats }} Seats Booked
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-light text-center border-0 rounded-bottom-4">
                                <a href="{{ route('booking.create', ['bookable_id' => $screening->id, 'bookable_type' => get_class($screening)]) }}" 
                                   class="btn btn-primary w-100 shadow-sm rounded-pill">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-muted fst-italic">No screenings available for this movie yet.</p>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

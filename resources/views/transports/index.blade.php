<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
        padding-top: 80px; /* Adjust the height based on your navbar height */
    }

    .container {
        max-width: 1200px;
    }

    .section-title {
        color: white;
        padding: 12px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .buses-title { background-color: #007bff; } /* Blue */
    .trains-title { background-color: #28a745; } /* Green */
    .planes-title { background-color: #dc3545; } /* Red */

    .card {
        background: linear-gradient(135deg, #ffffff, #e3e3e3);
        border-radius: 15px;
        transition: 0.3s ease-in-out;
        height: 100%;
    }

    .card:hover {
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    }

    .no-availability {
        text-align: center;
        font-style: italic;
        color: #dc3545;
        font-size: 1.2rem;
    }

    .card-body {
        padding: 20px;
    }

    .card-body p {
        font-size: 14px;
    }

    .card-body .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        padding: 10px;
    }

    .card-body .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Customizing images */
    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-radius: 15px;
    }

    /* Spacing for smaller screens */
    @media (max-width: 767px) {
        .container {
            padding: 0 15px;
        }

        .card-body .btn-primary {
            font-size: 14px;
        }
    }
</style>

<body class="mt-6">
    <x-header />
    <div class="container mt-4">
        <x-search-box search-route="{{ route('transport.index') }}" placeholder="Search transports..." class="mb-4" />
        
        @if (request('search'))
            <p class="text-center fst-italic text-muted">Search results for: <strong>{{ request('search') }}</strong></p>
        @endif

        <!-- Buses Section -->
        <h2 class="section-title buses-title">Buses</h2>
        <div class="row">
            @forelse ($buses as $bus)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card shadow-sm">
                        @if ($bus->image)
                            <img src="{{ asset('storage/' . $bus->image) }}" alt="{{ $bus->name }}" class="card-img-top rounded-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $bus->name }}</h5>
                            <p class="card-text"><strong>Route:</strong> {{ $bus->route->origin }} to {{ $bus->route->destination }}</p>
                            <p class="card-text"><strong>Duration:</strong> {{ $bus->route->duration }} hrs</p>
                            <p class="card-text"><strong>Departure Time:</strong> {{ $bus->departure_time }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($bus->ticket_price, 2) }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $bus->id, 'bookable_type' => get_class($bus)]) }}" class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-availability">No buses available for this route at this time.</p>
            @endforelse
        </div>

        <!-- Trains Section -->
        <h2 class="section-title trains-title">Trains</h2>
        <div class="row">
            @forelse ($trains as $train)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card shadow-sm">
                        @if ($train->image)
                            <img src="{{ asset('storage/' . $train->image) }}" alt="{{ $train->name }}" class="card-img-top rounded-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $train->name }}</h5>
                            <p class="card-text"><strong>Route:</strong> {{ $train->route->origin }} to {{ $train->route->destination }}</p>
                            <p class="card-text"><strong>Duration:</strong> {{ $train->route->duration }} hrs</p>
                            <p class="card-text"><strong>Departure Time:</strong> {{ $train->departure_time }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($train->ticket_price, 2) }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $train->id, 'bookable_type' => get_class($train)]) }}" class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-availability">No trains available for this route at this time.</p>
            @endforelse
        </div>

        <!-- Planes Section -->
        <h2 class="section-title planes-title">Planes</h2>
        <div class="row">
            @forelse ($planes as $plane)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card shadow-sm">
                        @if ($plane->image)
                            <img src="{{ asset('storage/' . $plane->image) }}" alt="{{ $plane->name }}" class="card-img-top rounded-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-danger">{{ $plane->name }}</h5>
                            <p class="card-text"><strong>Route:</strong> {{ $plane->route->origin }} to {{ $plane->route->destination }}</p>
                            <p class="card-text"><strong>Duration:</strong> {{ $plane->route->duration }} hrs</p>
                            <p class="card-text"><strong>Departure Time:</strong> {{ $plane->departure_time }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($plane->ticket_price, 2) }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $plane->id, 'bookable_type' => get_class($plane)]) }}" class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-availability">No planes available for this route at this time.</p>
            @endforelse
        </div>
    </div>
</body>

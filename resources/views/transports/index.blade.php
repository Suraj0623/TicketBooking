<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        max-width: 900px;
    }

    .section-title {
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 20px;
    }

    .buses-title { background-color: #007bff; } /* Blue */
    .trains-title { background-color: #28a745; } /* Green */
    .planes-title { background-color: #dc3545; } /* Red */

    .card {
        background: linear-gradient(135deg, #ffffff, #e3e3e3);
        border-radius: 10px;
        transition: 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .no-availability {
        text-align: center;
        font-style: italic;
        color: #dc3545;
    }
</style>

<body class="mt-6">
    <x-header />
    <div class="container mt-4">
        
       <!-- Buses Section -->
<h2 class="section-title buses-title">Buses</h2>
<div class="row">
    @forelse ($buses as $bus)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $bus->name }}</h5>
                    {{-- <p class="card-text"><strong>Capacity:</strong> {{ $bus->capacity }}</p> --}}
                    <p class="card-text"><strong>Origin:</strong> {{ $bus->route->origin }}</p>
                    <p class="card-text"><strong>Destination:</strong> {{ $bus->route->destination }}</p>
                    <p class="card-text"><strong>Duration:</strong> {{ $bus->route->duration }} hrs</p>
                    {{-- <p class="card-text"><strong>Departure:</strong> {{ $bus->departure_date->format('H:i A') }}</p> --}}
                    <p class="card-text"><strong>Arrival:</strong> {{ $bus->departure_time }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $bus->ticket_price }}</p>
                    <a href="{{ route('booking.create', ['bookable_id' => $bus->id, 'bookable_type' => get_class($bus)]) }}"
                        class="btn btn-primary w-100">Book Now</a>
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
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $train->name }}</h5>
                            <p class="card-text"><strong>Capacity:</strong> {{ $train->capacity }}</p>
                            <p class="card-text"><strong>Origin:</strong> {{ $train->route->origin }}</p>
                            <p class="card-text"><strong>Destination:</strong> {{ $train->route->destination }}</p>
                            <p class="card-text"><strong>Duration:</strong> {{ $train->route->duration }} hrs</p>
                            {{-- <p class="card-text"><strong>Departure:</strong> {{ $train->departure_date->format('H:i A') }}</p> --}}
                            <p class="card-text"><strong>Arrival:</strong> {{ $train->arrival_time }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ $train->price }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $train->id, 'bookable_type' => get_class($train)]) }}"
                                class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-availability">No train available for this route at this time.</p>
            @endforelse
        </div>

        <!-- Planes Section -->
        <h2 class="section-title planes-title">Planes</h2>
        <div class="row">
            @forelse ($planes as $plane)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-danger">{{ $plane->name }}</h5>
                            <p class="card-text"><strong>Capacity:</strong> {{ $plane->capacity }}</p>
                            <p class="card-text"><strong>Origin:</strong> {{ $plane->route->origin }}</p>
                            <p class="card-text"><strong>Destination:</strong> {{ $plane->route->destination }}</p>
                            <p class="card-text"><strong>Duration:</strong> {{ $plane->route->duration }} hrs</p>
                            {{-- <p class="card-text"><strong>Departure:</strong> {{ $plane->departure_date->format('H:i A') }}</p> --}}
                            <p class="card-text"><strong>Arrival:</strong> {{ $plane->arrival_time }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ $plane->price }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $plane->id, 'bookable_type' => get_class($plane)]) }}"
                                class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-availability">No plane available for this route at this time.</p>
            @endforelse
        </div>

    </div>
</body>

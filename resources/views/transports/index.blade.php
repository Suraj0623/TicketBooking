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
        background-color: #007bff;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 20px;
    }

    .card {
        background: linear-gradient(135deg, #ffffff, #e3e3e3);
        border-radius: 10px;
        transition: 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        background-color: #28a745;
        border: none;
    }

    .btn-primary:hover {
        background-color: #218838;
    }

    .no-availability {
        text-align: center;
        font-style: italic;
        color: #dc3545;
    }
</style>

<div class="container mt-4">
    <x-search-box search-route="{{ route('transport.index') }}" placeholder="Search transports..." />

    @if (request('search'))
        <p class="text-center text-secondary">Search results for: <strong>{{ request('search') }}</strong></p>
    @endif
    <div class="container">
        <h2>Transport Search Results</h2>
    
        <!-- Search Filters Display -->
        <div class="mb-4">
            <p><strong>Origin:</strong> {{ request('origin') }}</p>
            <p><strong>Destination:</strong> {{ request('destination') }}</p>
            <p><strong>Departure Date:</strong> {{ request('departure_date') }}</p>
        </div>
    <!-- Buses Section -->
    <h2 class="section-title">Buses</h2>
    <div class="row justify-content-center">
        @if ($buses->isNotEmpty())
            @foreach ($buses as $bus)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $bus->name }}</h5>
                            <p class="card-text"><strong>Capacity:</strong> {{ $bus->capacity }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $bus->id, 'bookable_type' => get_class($bus)]) }}"
                                class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="no-availability">No buses available for this route at this time.</p>
        @endif
    </div>

    <!-- Trains Section -->
    <h2 class="section-title bg-success">Trains</h2>
    <div class="row justify-content-center">
        @if ($trains->isNotEmpty())
            @foreach ($trains as $train)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $train->name }}</h5>
                            <p class="card-text"><strong>Capacity:</strong> {{ $train->capacity }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $train->id, 'bookable_type' => get_class($train)]) }}"
                                class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="no-availability">No trains available for this route at this time.</p>
        @endif
    </div>

    <!-- Planes Section -->
    <h2 class="section-title bg-danger">Planes</h2>
    <div class="row justify-content-center">
        @if ($planes->isNotEmpty())
            @foreach ($planes as $plane)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-danger">{{ $plane->name }}</h5>
                            <p class="card-text"><strong>Capacity:</strong> {{ $plane->capacity }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $plane->id, 'bookable_type' => get_class($plane)]) }}"
                                class="btn btn-primary w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="no-availability">No planes available for this route at this time.</p>
        @endif
    </div>
</div>
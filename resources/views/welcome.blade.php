<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .search-bar {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-radius: 10px;
        }

        .search-input {
            border-radius: 20px;
        }

        .hero-section {
            position: relative;
            height: 450px;
            background: url("{{ asset('images/new.avif') }}") no-repeat center center/cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .social-icons img {
            width: 16px;
            height: 16px;
        }

        .bg-purple {
            background: linear-gradient(to right, purple, rgba(66, 145, 98, 0.666), red);
        }
    </style>
</head>

<body class="bg-purple">

    <!-- Navigation Bar -->
    <x-header />

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay">
            <h1 class="display-4 fw-bold">Book Affordable Flights & More</h1>
            <p class="lead">Find flights, tours, transport, and events easily.</p>
        </div>
    </section>

    <!-- Search Bar -->
    <section class="container my-4">
        <div class="search-bar shadow p-3">
            <form action="{{ route('search') }}" method="GET">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <input type="text" name="query" class="form-control search-input"
                            placeholder="Search for services, destinations..." required>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select search-input">
                            <option value="">All Categories</option>
                            <option value="transport">Transport</option>
                            <option value="movie">Movies</option>
                            <option value="event">Events</option>
                            <option value="tour">Tours</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Features Section -->

    {{-- <section class="container py-5 text-center">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-4 shadow">
                    <i class="fas fa-plane text-danger display-4"></i>
                    <h5 class="mt-3">Flights</h5>
                    <p>Book flights to various destinations at the best prices.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 shadow">
                    <i class="fas fa-bus text-success display-4"></i>
                    <h5 class="mt-3">Bus</h5>
                    <p>Find and book intercity and local buses with ease.</p>
                </div>
            </div> --}}

            <div class="container py-4">
                <div class="row">
                    <!-- Services Section -->
                    <div class="col-md-8">
                        <div class="row">
                            <h2 class="text-center mb-3">Our Services</h2>
                            @foreach ($services as $service)
                                <div class="col-md-8 col-12 mb-3">
                                    <div class="card p-3 shadow-sm">
                                        <img src="{{ asset($service['image']) }}" class="card-img-top"
                                            alt="{{ $service['title'] }}" style="height: 150px; object-fit: cover;">
                                        <i class="fas fa-calendar-check text-primary fs-2"></i>
                                        <h6 class="mt-2 text-center fs-4">{{ $service['title'] }}</h6>
                                        <p class="small text-center fs-4">{{ Str::limit($service['description'], 60) }}</p>
                                        <a href="{{ route($service['route']) }}" class="btn btn-lg btn-primary">Explore</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Recommend Activities Section -->
                    <div class="col-md-4">
                        <h2>Recommended for You</h2>
                        @if ($recommendations->isEmpty())
                            <p>No recommendations available at this time.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($recommendations as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $item->title ?? $item->name }}</strong>
                                            <p class="small">{{ Str::limit($item->description, 50) }}</p>
                                        </div>
                                        <a href="{{ route('booking.create', ['bookable_type' => get_class($item), 'bookable_id' => $item->id]) }}"
                                            class="btn btn-sm btn-primary">Book Now</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>


            <!-- Footer -->
            <x-footer />

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
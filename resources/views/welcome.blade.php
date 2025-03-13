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

        /* Styling for Horizontal Layout */
        .horizontal-section {
            display: flex;
            overflow-x: auto;
            gap: 1.5rem;
            padding: 1rem 0;
        }

        .horizontal-section::-webkit-scrollbar {
            height: 8px;
        }

        .horizontal-section::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .horizontal-section::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .horizontal-item {
            flex: 0 0 auto;
            width: 300px; /* Increased width */
            min-width: 300px; /* Increased minimum width */
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .horizontal-item:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .horizontal-item img {
            width: 100%;
            height: 200px; /* Increased height */
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .horizontal-item .content {
            padding: 1rem;
        }

        /* Recommended for You Section */
        .recommended-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Responsive grid layout */
            gap: 1.5rem;
        }

        .recommended-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .recommended-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .recommended-item .details {
            margin-bottom: 1rem;
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

    <!-- Services Section -->
    <div class="container py-4">
        <h2 class="text-center mb-4">Our Services</h2>
        <div class="horizontal-section">
            @foreach ($services as $service)
                <div class="horizontal-item">
                    <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}">
                    <div class="content">
                        <h6 class="mb-2">{{ $service['title'] }}</h6>
                        <p class="small">{{ Str::limit($service['description'], 60) }}</p>
                        <a href="{{ route($service['route']) }}" class="btn btn-sm btn-primary w-100">Explore</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recommend Activities Section -->
    <div class="container py-4">
        <h2 class="text-center mb-4">Recommended for You</h2>
        @if ($recommendations->isEmpty())
            <p class="text-center">No recommendations available at this time.</p>
        @else
            <div class="recommended-grid">
                @foreach ($recommendations as $item)
                    <div class="recommended-item">
                        <div class="details">
                            <strong>{{ $item->title ?? $item->name }}</strong>
                            <p class="small">{{ Str::limit($item->description, 50) }}</p>
                        </div>
                        <a href="{{ route('booking.create', ['bookable_type' => get_class($item), 'bookable_id' => $item->id]) }}"
                            class="btn btn-sm btn-primary w-100">Book Now</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer -->
    <x-footer />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
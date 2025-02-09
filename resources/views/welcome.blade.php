<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Booking System</title>
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
        .social-icons img {
            width: 16px;
            height: 16px;
        }
        .authentication a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body style="background-image: url('{{ asset('images/new.avif') }}'); background-size: cover; background-attachment: fixed; height: 100vh; background-position: center;" class="bg-body">

    <!-- Navigation Bar -->
    <x-header />

   

    <!-- Hero Section with Search Bar -->
    <section class="text-center text-white py-5">
        <h1 class="display-4 fw-bold">Find Your Next Experience</h1>
        <p class="lead">Book transport, movies, events, or tours easily.</p>
        <div class="container mt-4">
            <div class="search-bar mx-auto col-lg-8 shadow">
                <form action="{{ route('search') }}" method="GET">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <input type="text" name="query" class="form-control search-input" placeholder="Search for services, destinations..." required>
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
        </div>
    </section>

    <!-- Services Section -->
    <main class="container py-5">
        <h2 class="text-center mb-4">Our Services</h2>
        <div class="row g-4 justify-content-center">
            @foreach ($services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="card service-card text-bg-dark">
                        <img src="{{ asset($service['image']) }}" class="card-img-top" alt="{{ $service['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service['title'] }}</h5>
                            <p class="card-text">{{ $service['description'] }}</p>
                            <a href="{{ route($service['route']) }}" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

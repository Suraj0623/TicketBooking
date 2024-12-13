<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home Page</title>
</head>
<body style="background-image: url('{{ asset('images/new.avif') }}'); background-size: cover; background-attachment: fixed; height: 100vh; background-position: center;" class="bg-body">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 position-fixed top-0 w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('welcome')}}">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo" height="50">
            </a>
            <div class="d-flex">
                <a class="btn btn-outline-light me-2" href="{{ route('tour.index') }}">Tours</a>
                @auth
                    <a class="btn btn-outline-light me-2" href="{{ route('ticket.index') }}">My Bookings</a>
                @endauth
                <a class="btn btn-outline-light me-2" href="{{ route('home') }}">Start Your Journey</a>
                <a class="btn btn-outline-light me-2" href="{{ route('faq') }}">FAQ</a>
                <a class="btn btn-outline-light me-2" href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="d-flex text-center">
                @auth
                    <a href="{{ route('profile.index') }}" class="btn btn-primary btn-sm me-2">View Profile</a>
                    @if(auth()->user()->roles->contains('roleName', 'admin'))
                    <a href="{{ route('dashboardPage') }}" class="btn btn-secondary btn-sm me-2" title="Go to the dashboard">Dashboard</a>
                @endif
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-warning text-white">Register</a>
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="text-center text-black py-5">
        <h2>Choose A Service</h2>
        <p>Select a service to search and book available options.</p>
        <div class="container">
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-5 mb-4 ms-3">
                        <div class="card text-bg-dark w-100">
                            <img src="{{ asset($service['image']) }}" class="card-img-top" alt="{{ $service['title'] }}">
                            <div class="card-img-overlay">
                                <h5 class="card-title">{{ $service['title'] }}</h5>
                                <p class="card-text">{{ $service['description'] }}</p>
                            </div>
                        </div>
                        <a href="{{ route($service['route']) }}" class="btn btn-primary mb-3">GO</a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

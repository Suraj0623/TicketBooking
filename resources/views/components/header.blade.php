<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'My Application' }}</title>
    <!-- Include a CSS framework (e.g., Bootstrap, Tailwind) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
       body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
}
    </style>
</head>
<body>
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
                    @if(auth()->check() && auth()->user()->roles->contains('name', 'admin'))
                        <a href="{{ route('dashboardPage') }}" class="btn btn-secondary btn-sm me-2">Dashboard</a>
                    @endif
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-warning text-white">Register</a>
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container">
        {{ $slot }}
    </main>

    <!-- Include JavaScript framework (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

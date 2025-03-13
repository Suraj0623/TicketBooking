<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75 fixed-top">
    <div class="container-fluid">
        <!-- Brand Logo and Name -->
        <a class="navbar-brand me-auto d-flex align-items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.webp') }}" alt="BookMyTicket Logo" height="50" class="me-2">
            <span class="fs-5 fw-bold">BookMyTicket</span>
        </a>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-3">
                @auth
                    <!-- Authenticated User Links -->
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{ route('ticket.index') }}">My Bookings</a>
                    </li>
                    @php
                        $role = Auth::user()->roles->whereIn('roleName', ['SuperAdmin', 'admin'])->first();
                    @endphp
                    @if ($role)
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link fs-5">Dashboard</a>
                        </li>
                    @endif
                @endauth

                <!-- Dropdown for Services -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" id="servicesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="{{ route('movie.index') }}">Movies</a></li>
                        <li><a class="dropdown-item" href="{{ route('transport.index') }}">Transports</a></li>
                        <li><a class="dropdown-item" href="{{ route('event.index') }}">Events</a></li>
                        <li><a class="dropdown-item" href="{{ route('tour.index') }}">Tours</a></li>
                    </ul>
                </li>

                <!-- General Links -->
                <li class="nav-item">
                    <a class="nav-link fs-5" href="{{ route('home') }}">Start Journey</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5" href="{{ route('faq') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5" href="{{ route('contact') }}">Assistance</a>
                </li>
            </ul>

            <!-- Authentication Buttons -->
            <div class="d-flex align-items-center">
                @auth
                    <!-- Profile and Logout -->
                    <a class="btn btn-primary btn-sm fs-6 me-2" href="{{ route('profile.index') }}">Profile</a>
                    <a class="btn btn-danger btn-sm fs-6" href="{{ route('logout') }}">Logout</a>
                @else
                    <!-- Sign In -->
                    <a class="btn btn-light btn-sm d-flex align-items-center fs-6" href="{{ route('login') }}">
                        <i class="fas fa-user-circle me-2"></i>
                        <span>Sign In</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand me-auto" href="{{route('welcome')}}">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo" height="50" class="me-2"> 
            <span class="fs-5 fw-bold">BookMyTicket</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link fs-5" href="{{ route('tour.index') }}">Tours</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link fs-5" href="{{ route('ticket.index') }}">My Bookings</a></li>
                @endauth
                <li class="nav-item"><a class="nav-link fs-5" href="{{ route('home') }}">Start Journey</a></li>
                <li class="nav-item"><a class="nav-link fs-5" href="{{ route('faq') }}">FAQ</a></li>
                <li class="nav-item"><a class="nav-link fs-5" href="{{ route('contact') }}">Assistance</a></li>
            </ul>

            <!-- Separated Register/Login Buttons -->
            <div class="ms-3">
                @auth
                    <a class="btn btn-primary btn-sm fs-6" href="{{ route('profile.index') }}">Profile</a>
                    <a class="btn btn-danger btn-sm fs-6" href="{{ route('logout') }}">Logout</a>
                @else

                    <a class="btn  bg-light d-flex align-items-center fs-5" href="{{ route('login') }}">
                        <i class="fas fa-user-circle me-2"></i>
                        <span>Sign in</span>
                    </a>


                @endauth
            </div>
        </div>
    </div>
</nav>

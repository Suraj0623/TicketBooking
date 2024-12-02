<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - My Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Additional styles --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="admin-container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('dashboardPage') }}">Admin Panel</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('booking.index') }}">Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Welcome</a></li>
                
                <div class="d-flex text-center">
                    @auth
                        <a href="{{route('ticket.index')}}" class="btn btn-primary btn-sm me-2" title="Manage Bookings">Manage Bookings</a>
                        @if(auth()->user()->roles->contains('roleName', 'admin'))
                            <a href="{{ route('dashboardPage') }}" class="btn btn-secondary btn-sm me-2" title="Dashboard">Dashboard</a>
                        @endif
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm" title="Logout">Logout</a>
                    @else
                        <a class="btn btn-warning text-white" href="{{ route('register') }}">Register</a>
                        <a href="{{ route('login') }}" class="btn btn-success btn-lg">Login</a>
                    @endauth
                </div>
            </ul>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

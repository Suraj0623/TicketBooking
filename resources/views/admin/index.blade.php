<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
   
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Top Bar -->
    <div class="container-fluid bg-dark text-white py-2">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Left Side Links -->
            <div class="d-flex">
                <a href="" class="btn btn-secondary btn-sm me-2" title="Movies">Movies</a>
                <a href="" class="btn btn-secondary btn-sm me-2" title="Events">Events</a>
                <a href="" class="btn btn-secondary btn-sm me-2" title="Tours">Tours</a>
                <!-- Add more items here as needed -->
            </div>
            <!-- Right Side Logout Button -->
            <div>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm" title="Logout from your account">Logout</a>
            </div>
        </div>
    </div>
    

    <!-- Main Content -->
    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 bg-light sidebar py-4">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item mb-3">
                        <h5 class="text-primary">Welcome, {{ Auth::user()->FirstName }}</h5>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('welcome') }}">
                            <i class="fas fa-home"></i> Go To Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('offer.create') }}">
                            <i class="fas fa-gift"></i> Offers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking.index') }}">
                            <i class="fas fa-ticket-alt"></i> Bookings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transports.index') }}">
                            <i class="fas fa-bus"></i> Transport
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('route.index') }}">
                            <i class="fas fa-map-marked-alt"></i> Routes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">
                            <i class="fas fa-calendar-alt"></i> Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tours.index') }}">
                            <i class="fas fa-suitcase"></i> Tours
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.index') }}">
                            <i class="fas fa-film"></i> Movies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.manage') }}">
                            <i class="fas fa-user-shield"></i> Admins
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <main role="main" class="col-md-9 col-lg-10 px-md-4 py-4">
            <div class="container">
                <section id="dashboard">
                    <!-- Dashboard Status Boxes -->
                    <div id="status" class="row">
                        <div class="col-md-4">
                            <div id="Booking" class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Bookings</h5>
                                        <i class="fas fa-ticket-alt fa-2x"></i>
                                    </div>
                                    <p class="card-text">Total Bookings</p>
                                    <p class="h4">0</p>
                                    <a href="{{ route('booking.index') }}" class="btn btn-light btn-sm">View More <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Add more status items here -->
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <x-footer />

    <!-- Bootstrap JS and custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin_dashboard.js') }}"></script>
</body>
</html>

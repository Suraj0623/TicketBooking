<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="admin-container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboardPage') }}">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('welcome') }}">Welcome</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li><a class="dropdown-item" href="{{ route('movie.index') }}">Movies</a></li>
                                <li><a class="dropdown-item" href="{{ route('transport.index') }}">Transports</a></li>
                                <li><a class="dropdown-item" href="{{ route('event.index') }}">Event</a></li>
                                <li><a class="dropdown-item" href="{{ route('tour.index') }}">Tours</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
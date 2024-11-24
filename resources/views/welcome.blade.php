<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Home Page</title>
</head>
<body style="background-image: url('{{ asset('images/new.avif') }}'); background-size: cover; background-attachment: fixed; height: 100vh; background-position: center;">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 position-fixed top-0 w-100" style="z-index: 1050;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo" height="50">
            </a>
            <div class="d-flex">
                <a class="btn btn-outline-light me-2" href="{{route('tour.index')}}">Tours</a>
                <a class="btn btn-outline-light me-2" href="">Booking</a>
                <a class="btn btn-outline-light me-2" href="{{route('home')}}">Start Your Journey</a>
                <a class="btn btn-outline-light me-2" href="">FAQ</a>
                <a class="btn btn-outline-light me-2" href="{{ route('about') }}">Contact</a>
            </div>
            <div class="d-flex text-center">
                @auth
                <a href="" class="btn btn-primary btn-sm me-2" title="View and manage all bookings">Manage Bookings</a>
                @if(auth()->user()->roles->contains('roleName', 'admin'))
                <a href="{{ route('dashboardPage') }}" class="btn btn-secondary btn-sm me-2" title="Go to the dashboard">Dashboard</a>
            @endif
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm" title="Logout from your account">Logout</a>

                
                
            @else
                <a class="btn btn-warning text-white" href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}" class="btn btn-success btn-lg">Login</a>
            @endauth
            </div>
        </div>
    </nav>
    
    
    
    

    <!-- Main Content -->
    <main class="text-center text-black py-5 position-relative z-index-1">
        <h2>Find the Perfect Bus Trip for You</h2>
        <p>Please select a trip and date to search for available buses.</p>

       
<!-- Card Layout -->
<div class="container">
    <div class="row">
        <!-- First Card (Left) -->
        <div class="col-md-5 mb-4 ms-3"> <!-- Changed col-md-5 to col-md-6 for 2 cards per row -->
            <div class="card text-bg-dark w-100" style="min-width: 12rem;">
                <img src="{{asset('images/transport.webp')}}" class="card-img-top" alt="transportImage">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title 1</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small>Last updated 3 mins ago</small></p>
                </div>
             </div>
             <button class="btn btn-primary mb-3"> <a href="{{route('transport.index')}}"> GO</a></button>

        </div>

        <!-- Second Card (Left) -->
        <div class="col-md-5 mb-4 ms-3"> <!-- Changed col-md-5 to col-md-6 for 2 cards per row -->
            <div class="card text-bg-dark w-100" style="min-width: 12rem;">
                <img src="{{asset('images/movie.webp')}}" class="card-img-top" alt="movieImage">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title 2</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small>Last updated 3 mins ago</small></p>
                </div>
            </div>
            <button class="btn btn-primary mb-3"> <a href="{{route('movie.index')}}"> GO</a></button>
        </div>
    
    
        <!-- Third Card (Right) -->
        <div class="col-md-5 mb-4 ms-3"><!-- Changed col-md-5 to col-md-6 for 2 cards per row -->
            <div class="card text-bg-dark w-100" style="min-width: 12rem;">
                <img src="{{asset('images/concert.webp')}}" class="card-img-top" alt="concertImage">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title 3</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small>Last updated 3 mins ago</small></p>
                   
                </div>
            </div>
            <button class="btn btn-primary mb-3"> <a href="{{route('event.index')}}"> GO</a></button>  
        </div>
        

        <!-- Fourth Card (Right) -->
        <div class="col-md-5 mb-4 ms-3"> <!-- Changed col-md-5 to col-md-6 for 2 cards per row -->
            <div class="card text-bg-dark w-100" style="min-width: 12rem;">
                <img src="{{asset('images/tours.webp')}}" class="card-img-top" alt="toursImage">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title 4</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small>Last updated 3 mins ago</small></p>
                </div>
            </div>
            <button class="btn btn-primary mb-3"> <a href="{{route('tour.index')}}"> GO</a></button>
        </div>
    </div>
</div>

    </main>
   
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Footer -->
    <footer class="bg-dark bg-opacity-75 text-center text-white py-4">
        <p>Why WhereTo? for Bus Booking?<br>
            The leading player in online Bus bookings in Nepal, WhereTo?<br>
            offers lowest fares, exclusive discounts and a seamless online booking experience.<br>
            Desktop site is a delightfully customer-friendly experience, and with just a few clicks you can complete your booking.</p>
        <p>&copy; 2023 Online Bus Reservation. All rights reserved.</p>
    </footer>
</body>
</html>

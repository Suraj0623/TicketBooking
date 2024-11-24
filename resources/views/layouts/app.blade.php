<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bus Sewa - Tours')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 position-fixed top-0 w-100" style="z-index: 1050;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('welcome')}}">
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
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <p><img src="{{ asset('images/logo.png') }}" width="150" height="36" alt="BusSewa"></p>
                    <p>BusSewa – Nepal’s first online realtime bus ticket booking platform powered by Diyalo Technologies Pvt. Ltd.</p>
                </div>
                <div class="col-lg-3">
                    <h5>Useful Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('tour.index') }}">Tours</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="tel://+977015970798">01-5970798</a></li>
                        <li><a href="mailto:info@bussewa.com">info@bussewa.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                // Example validation logic
                const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
                let isValid = true;
    
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid'); // Add a class to style invalid fields
                        const errorMessage = input.nextElementSibling || document.createElement('span');
                        errorMessage.textContent = 'This field is required.';
                        errorMessage.style.color = 'red';
                        input.after(errorMessage);
                    } else {
                        input.classList.remove('is-invalid');
                        const errorMessage = input.nextElementSibling;
                        if (errorMessage) {
                            errorMessage.textContent = '';
                        }
                    }
                });
    
                if (!isValid) {
                    event.preventDefault(); // Prevent the form submission if validation fails
                    alert('Please fill out all required fields.');
                }
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
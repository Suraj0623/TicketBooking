{{-- <!-- resources/views/components/footer.blade.php -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>
                    We are committed to providing the best services for your ticket booking needs. 
                    Contact us for more information.
                </p>
            </div>
            <!-- Links Section -->
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{route('welcome')}}" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{{route('about')}}" class="text-white text-decoration-none">About Us</a></li>
                    <li><a href="{{route('contact')}}" class="text-white text-decoration-none">Contact</a></li>
                    <li><a href="{{route('faq')}}" class="text-white text-decoration-none">FAQ</a></li>
                </ul>
            </div>
            <!-- Contact Section -->
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p><strong>Email:</strong> support@example.com</p>
                <p><strong>Address:</strong> 123 Main Street, Cityville, USA</p>
            </div>
        </div>
        <div class="text-center mt-3">
            <p class="mb-0">&copy; {{ date('Y') }} Your Company Name. All Rights Reserved.</p>
        </div>
    </div>
</footer> --}}

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-3 mb-4">
                <h5>About Us</h5>
                <p>
                    We are committed to providing the best services for your ticket booking needs. 
                    Contact us for more information.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-3 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('welcome') }}" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-white text-decoration-none">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white text-decoration-none">Contact</a></li>
                    <li><a href="{{ route('faq') }}" class="text-white text-decoration-none">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="col-md-3 mb-4">
                <h5>Contact Us</h5>
                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p><strong>Email:</strong> support@example.com</p>
                <p><strong>Address:</strong> 123 Main Street, Cityville, USA</p>
            </div>

            <!-- Download Section -->
            <div class="col-md-3 mb-4">
                <h5>Download App</h5>
                <a href="#"><img src="https://storage.googleapis.com/a1aa/image/Hpk126Xn5VnMd0i68d_YRB7b9FbCNSD_5RjLeIBsBMk.jpg" alt="App Store" width="150"></a>
                <a href="#"><img src="https://storage.googleapis.com/a1aa/image/h1GNnu1g2FEBV9nZneOBdCVPn-Ft826KsqNkjDnB8QU.jpg" alt="Google Play" width="150"></a>
            </div>
        </div>

        <hr class="border-light">

        <!-- Social Media & Powered By -->
        <div class="row text-center text-md-start">
            <div class="col-md-6 mb-3">
                <h5>Follow Us</h5>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-tiktok"></i></a>
            </div>

            <div class="col-md-6 text-md-end">
                <h5>Powered By</h5>
                <img src="https://storage.googleapis.com/a1aa/image/42bBMoPuI5amBcbBfv216hAVagTz__C2m8wTMquoHZ4.jpg" alt="Natraj Tours & Travels" width="100">
            </div>
        </div>

        <hr class="border-light">

        <!-- Copyright Section -->
        <div class="text-center">
            <p class="mb-0">
                &copy; {{ date('Y') }} BookMyTicket | All Rights Reserved | Made with <i class="fas fa-heart text-danger"></i> in Nepal
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap & FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

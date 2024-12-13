<!-- resources/views/components/footer.blade.php -->
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
</footer>

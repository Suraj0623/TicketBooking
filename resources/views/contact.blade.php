<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .search-bar {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-radius: 10px;
        }

        .search-input {
            border-radius: 20px;
        }

        .hero-section {
            position: relative;
            height: 450px;
            background: url("{{ asset('images/new.avif') }}") no-repeat center center/cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .social-icons img {
            width: 16px;
            height: 16px;
        }

        .bg-purple {
            background: linear-gradient(to right, purple, rgba(66, 145, 98, 0.666), red);
        }

        /* Styling for Horizontal Layout */
        .horizontal-section {
            display: flex;
            overflow-x: auto;
            gap: 1.5rem;
            padding: 1rem 0;
        }

        .horizontal-section::-webkit-scrollbar {
            height: 8px;
        }

        .horizontal-section::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .horizontal-section::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .horizontal-item {
            flex: 0 0 auto;
            width: 300px;
            /* Increased width */
            min-width: 300px;
            /* Increased minimum width */
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .horizontal-item:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .horizontal-item img {
            width: 100%;
            height: 200px;
            /* Increased height */
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .horizontal-item .content {
            padding: 1rem;
        }

        /* Recommended for You Section */
        .recommended-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            /* Responsive grid layout */
            gap: 1.5rem;
        }

        .recommended-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .recommended-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .recommended-item .image-container {
            width: 100%;
            height: 150px;
            /* Fixed height for the image container */
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .recommended-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image fits within the container without distortion */
        }

        .recommended-item .details {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="bg-purple">

    <!-- Navigation Bar -->
    <x-header />

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="text-center mb-4 text-white">Enquiry</h1>
        <p class="text-center mb-5 text-white">
            Have questions or need assistance? Feel free to reach out to us using the form below or via the provided contact information.
        </p>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-4">
                <div class="bg-light p-4 rounded shadow">
                    <h4>Contact Information</h4>
                    <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                    <p><strong>Email:</strong> support@example.com</p>
                    <p><strong>Address:</strong> 123 Main Street, Suite 100<br>Cityville, USA</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-8">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label text-white">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <!-- Subject -->
                    <div class="mb-3">
                        <label for="subject" class="form-label text-white">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
                    </div>
                    <!-- Message -->
                    <div class="mb-3">
                        <label for="message" class="form-label text-white">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
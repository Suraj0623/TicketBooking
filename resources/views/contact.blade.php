<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Contact Us</h1>
        <p class="text-center mb-5">Have questions or need assistance? Feel free to reach out to us using the form below or via the provided contact information.</p>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-4">
                <div class="bg-light p-4 rounded">
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
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <!-- Subject -->
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
                    </div>
                    <!-- Message -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1

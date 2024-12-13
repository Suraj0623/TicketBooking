<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 position-fixed top-0 w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('welcome')}}">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo" height="50" >
            </a>
            <div class="d-flex">
                <a class="btn btn-outline-light me-2" href="{{ route('tour.index') }}">Tours</a>
                <a class="btn btn-outline-light me-2" href="{{ route('ticket.index') }}">Booking</a>
                <a class="btn btn-outline-light me-2" href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <h1 class="text-center mb-4">About Us</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Our Story</h3>
            </div>
            <div class="card-body">
                <p>
                    Founded in 2021, our company has quickly become one of the leading ticket booking platforms in the market. 
                    We started with the mission to make event and travel bookings easier, faster, and more accessible for everyone. 
                    From small local events to international tours, our platform provides a seamless experience for booking tickets, 
                    making travel planning a breeze.
                </p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Our Vision</h3>
            </div>
            <div class="card-body">
                <p>
                    To revolutionize the way people experience events and travel by providing a user-friendly, reliable, and secure platform 
                    that simplifies ticket booking, enhances customer satisfaction, and creates lasting memories.
                </p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Our Goals</h3>
            </div>
            <div class="card-body">
                <ul>
                    <li>Provide the best ticket booking experience for all events and travel options.</li>
                    <li>Expand our platform to include more services and destinations globally.</li>
                    <li>Offer personalized customer support and 24/7 assistance.</li>
                    <li>Ensure security, reliability, and user privacy in all transactions.</li>
                    <li>Continue to innovate and improve our booking technology for a seamless user experience.</li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Our Objectives</h3>
            </div>
            <div class="card-body">
                <ul>
                    <li>To increase our platform's reach by offering new services and expanding to new regions.</li>
                    <li>To develop a mobile app for easier access to our platform from anywhere.</li>
                    <li>To build partnerships with event organizers, transport services, and travel agencies.</li>
                    <li>To implement advanced features like real-time seat availability and instant ticket booking confirmations.</li>
                    <li>To maintain the highest standard of customer service and user experience.</li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Our Values</h3>
            </div>
            <div class="card-body">
                <p>
                    At the core of our business, we are guided by our values: integrity, innovation, and customer-centricity. We aim 
                    to not only meet but exceed our customers' expectations with every interaction, providing them with exceptional service 
                    and reliable solutions for all their event and travel needs.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer/>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

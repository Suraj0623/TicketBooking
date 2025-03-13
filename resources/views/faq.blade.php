<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ticket Booking FAQ</title>
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
    <div class="container mt-4 pt-5">
        <h1 class="mb-4 text-center text-white">Ticket Booking - Frequently Asked Questions</h1>
        <div class="accordion bg-white rounded p-4 shadow" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How can I book a ticket?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can book a ticket by visiting the <strong>Book Now</strong> section on our website. Select the event, movie, or tour, and complete the booking process by entering the required details and making the payment.
                    </div>
                </div>
            </div>
            <!-- FAQ 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What payment methods do you accept?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We accept various payment methods including credit/debit cards, PayPal, and other local payment gateways. Please check the payment options during checkout for more details.
                    </div>
                </div>
            </div>
            <!-- FAQ 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Can I cancel or modify my booking?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, you can cancel or modify your booking within the cancellation window specified for the event. Please refer to the cancellation policy or contact our support team for assistance.
                    </div>
                </div>
            </div>
            <!-- FAQ 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        How will I receive my ticket?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Once your booking is confirmed, the ticket will be sent to your registered email address. You can also access it in the <strong>My Bookings</strong> section on our website.
                    </div>
                </div>
            </div>
            <!-- FAQ 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        What should I do if I didn’t receive my ticket?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        If you didn’t receive your ticket, please check your spam/junk email folder first. If you still cannot find it, contact our support team with your booking reference number.
                    </div>
                </div>
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
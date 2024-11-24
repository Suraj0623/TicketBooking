<head>
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel/dist/assets/owl.theme.default.min.css">
    <!-- jQuery (required for Owl Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <!-- Tabs for Tour Packages and Reservations -->
    <div class="card" style="min-height: 400px; padding-top: 0.5rem; max-width: 1280px;">
        <div class="card-body">
            <!-- Tabs -->
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tourPackage-tab" data-bs-toggle="pill" href="#tourPackage" role="tab" aria-controls="tourPackage" aria-selected="true">Tour Package</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reservation-tab" data-bs-toggle="pill" href="#reservation" role="tab" aria-controls="reservation" aria-selected="false">Reservation</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                <!-- Tour Package Tab -->
                <div class="tab-pane fade show active" id="tourPackage" role="tabpanel" aria-labelledby="tourPackage-tab">
                    <p>Book Bus Tickets on Bus-Sewa with super-fast booking process and no service charge.</p>
                    <div class="list-group">
                        <div class="list-group-item d-flex align-items-center gap-2">
                            <img src="https://bussewa.com/images/svgs/ct.svg" class="img-fluid" style="height: 50px; width: 100px;" alt="">
                            <p class="fw-bold">Unique Packages</p>
                        </div>
                        <div class="list-group-item d-flex align-items-center gap-2">
                            <img src="https://bussewa.com/images/svgs/dr.svg" class="img-fluid" style="height: 50px; width: 100px;" alt="">
                            <p class="fw-bold">Comfortable Transport</p>
                        </div>
                        <div class="list-group-item d-flex align-items-center gap-2">
                            <img src="https://bussewa.com/images/svgs/apu.svg" class="img-fluid" style="height: 50px; width: 100px;" alt="">
                            <p class="fw-bold">Popular Destinations</p>
                        </div>
                    </div>
                    <a href="https://bussewa.com/tours">
                        <button class="btn btn-primary mt-3">Book Tour Package</button>
                    </a>
                </div>

                <!-- Reservation Tab -->
                <div class="tab-pane fade" id="reservation" role="tabpanel" aria-labelledby="reservation-tab">
                    <p>Book Bus Tickets on Bus-Sewa with super-fast booking process and no service charge.</p>
                    <div class="list-group">
                        <div class="list-group-item d-flex align-items-center gap-2">
                            <img src="https://bussewa.com/images/svgs/ct.svg" class="img-fluid" style="height: 50px; width: 100px;" alt="">
                            <p class="fw-bold">City-To-City</p>
                        </div>
                        <div class="list-group-item d-flex align-items-center gap-2">
                            <img src="https://bussewa.com/images/svgs/dr.svg" class="img-fluid" style="height: 50px; width: 100px;" alt="">
                            <p class="fw-bold">Hourly Rental</p>
                        </div>
                        <div class="list-group-item d-flex align-items-center gap-2">
                            <img src="https://bussewa.com/images/svgs/apu.svg" class="img-fluid" style="height: 50px; width: 100px;" alt="">
                            <p class="fw-bold">Airport Pickup</p>
                        </div>
                    </div>
                    <a href="https://bussewa.com/reservation">
                        <button class="btn btn-primary mt-3">Reserve Now</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#recommended').owlCarousel({
            loop: offerCount > 3,  // Loop the carousel
            margin: 10,             // Space between items
            nav: true,              // Show next/prev buttons
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

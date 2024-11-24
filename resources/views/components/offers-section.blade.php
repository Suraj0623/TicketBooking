<!-- resources/views/components/offers-section.blade.php -->
<div class="container mt-4">
    <div class="recommended-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="ribbon">Offers</h2>
            <a href="https://bussewa.com/promo-codes" class="btn btn-primary btn-sm rounded">View All</a>
        </div>
        <div id="recommended" class="owl-carousel owl-theme">
            @foreach ($offers as $index => $offer)
                <div class="item">
                    <div class="card" style="background-color: {{ $colors[$index % count($colors)] }};">
                        <a href="{{ url('promo-code/' . $offer->id) }}" target="_blank">
                            <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top" alt="{{ $offer->title }}">
                        </a>
                        <div class="card-body text-white">
                            <h5 class="card-title">{{ $offer->title }}</h5>
                            <p class="card-text">Valid Till: {{ \Carbon\Carbon::parse($offer->expiration_date)->format('M d, Y') }}</p>
                            <span class="coupon_code">{{ $offer->coupon_code }}</span>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <a href="{{ url('promo-code/' . $offer->id) }}" class="btn btn-light btn-sm">View Offer</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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

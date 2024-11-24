<head>
    <!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel/dist/assets/owl.theme.default.min.css">
<!-- jQuery (required for Owl Carousel) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Owl Carousel JS -->
<script src="https://cdn.jsdelivr.net/npm/owl.carousel/dist/owl.carousel.min.js"></script>

</head>
@php
    // Define an array of colors for the cards
    $colors = [
        'cyan',           // Color 1
        'blue',          // Color 2
        'green',         // Color 3
        'orange',        // Color 4
        'purple'         //color 5
        // Add more colors as needed
    ];
@endphp
<div class="container mt-4">
    <div class="reccomended_container">
        <div>
            <span><em></em></span>
            <div class="discount_offer_header">
                <h2 class="ribbon">Offers</h2>
                <p class="btn_home_align"><a href="" class="btn btn-primary rounded">View All</a></p>
            </div>
        </div>
        <div id="reccomended" class="owl-carousel owl-theme owl-loaded owl-drag">
            @foreach ($offers as $index=>$offer)
                <div class="item">
                    <div class="card" style="background-color: {{ $colors[$index % count($colors)] }};">
                        <a target="_blank" href="{{ url('promo-code/' . $offer->id) }}">
                            <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top" alt="{{ $offer->title }}">
                        </a>
                        <div class="card-body text-white">
                            <h5 class="card-title">{{ $offer->title }}</h5>
                            <p class="card-text">Valid Till: {{ \Carbon\Carbon::parse($offer->expiration_date)->format('M d, Y') }}</p>
                            <span class="coupon_code">{{ $offer->coupon_code }}</span>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <a href="{{ url('promo-code/' . $offer->id) }}" class="btn btn-light btn-sm">View Offer</a>
                                <span class="copy_coupon_button">
                                    <!-- You can add functionality to copy the coupon code here -->
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    var offerCount = {{ count($offers) }};
</script>

<style>
    .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: scale(1.05);
}

.card-body {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 0 0 10px 10px;
}

.card-title {
    font-weight: bold;
    font-size: 18px;
}
.card-text {
        font-size: 20px;
        font-weight: bold; /* Make expiration date bold */
    }
.owl-carousel .item {
    display: flex;
    justify-content: center;
}

.card {
    width: 100%;
    max-width: 300px;
    border-radius: 10px;
    transition: transform 0.2s ease-in-out;
  
}

.card:hover {
    transform: scale(1.05);
}




.coupon_code {
    font-size: 16px;
    font-weight: bold;
    color: #ffd700;
}

</style>
<script>
    $(document).ready(function() {
    $('#reccomended').owlCarousel({
        loop: offerCount > 3,         // Loop the carousel if there are more than 3 offers
        margin: 10,                  // Space between items
        nav: true,                   // Show next/prev buttons
        autoplay: true,              // Enable auto-slide
        autoplayTimeout: 3000,       // Set the delay for auto-slide (in milliseconds)
        autoplayHoverPause: true,    // Pause auto-slide on hover
        responsive: {
            0: {
                items: 1             // Show 1 item for small screens
            },
            600: {
                items: 2             // Show 2 items for medium screens
            },
            1000: {
                items: 3             // Show 3 items for large screens
            }
        }
    });
});

   

</script>

<x-header />

<!-- Styles for Enhanced UI -->
<style>
    body {
        background-color: #f4f4f4;
    }

    .container {
        max-width: 1100px;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        background-color: #fff;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.2);
    }

    .card img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-weight: bold;
        color: #007bff;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #218838);
        border: none;
        transition: 0.3s;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #218838, #1e7e34);
    }

    .booking-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .form-label {
        font-weight: 600;
    }
</style>

<main class="container my-4">
    <div class="row">
        <!-- Tour Details -->
        <div class="col-md-8">
            <div class="card">
                <figure>
                    @if ($tour->image)
                        <img src="{{ asset('/storage/' . $tour->image) }}" alt="Tour Image" class="card-img-top" style="width: 100%; height: 400px; object-fit: cover;">
                    @else
                        <img src="{{ asset('path/to/default-image.png') }}" alt="Default Image" class="card-img-top" style="width: 100%; height: 400px; object-fit: cover;">
                    @endif
                </figure>
                <div class="card-body">
                    <h5 class="card-title">{{ $tour->packageName }}</h5>
                    <p class="card-text">{{ $tour->description }}</p>
                    <p><strong>Price:</strong> NPR {{ $tour->ticket_price }}</p>
                    <p><strong>Duration:</strong> {{ $tour->duration }} Days</p>
                </div>
            </div>
        </div>

        <!-- Booking Info -->
        <div class="col-md-4">
            <div class="booking-card">
                <h4 class="text-center text-primary">Booking Info</h4>
                <form action="{{ route('booking.store', $tour->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Total Bookings</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" min="1" value="1" required>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('booking.create', ['bookable_id' => $tour->id, 'bookable_type' => get_class($tour)]) }}" class="btn btn-success w-100">Book Now</a>
                    </div>
                </form>
            </div>
            <div class="container">
                <div class="card">
                    <a href="{{route('welcome')}}" class="btn btn-lg bg-primary fs-5">Go Back</a>
                </div>
        </div>
        
        </div>
    </div>
</main>

<x-footer />

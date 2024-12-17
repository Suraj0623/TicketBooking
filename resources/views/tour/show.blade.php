<x-header/>

<main class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <figure>
                    @if ($tour->image)
                        <img src="{{ asset('/storage/'.$tour->image) }}" alt="Tour Image" class="card-img-top" style="width: 100%; height: 400px; object-fit: cover;">
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

        <div class="col-md-4">
            <h4>Booking Info</h4>
            <!-- Include your booking form here -->
            <form action="{{ route('booking.store', $tour->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="quantity" class="form-label">Total bookings</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" min="1" value="1" required>
                </div>
                <a href="{{ route('booking.create', ['bookable_id' => $tour->id, 'bookable_type' => get_class($tour)]) }}" class="btn btn-success">Book Now</a>
            </form>
        </div>
    </div>
</main>

<x-footer/>

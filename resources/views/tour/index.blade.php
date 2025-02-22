<x-header />

<!-- Styles for Enhanced UI -->
<style>
    body {
        background-color: #f4f4f4;
    }

    .container {
        max-width: 1100px;
    }

    .search-box {
        background-color: #007bff;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
    }

    .search-box input {
        width: 100%;
        border-radius: 5px;
        padding: 8px;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }

    .card img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-title a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #004494);
    }

    .list-group-item {
        background: #f8f9fa;
    }

    .no-results {
        text-align: center;
        font-style: italic;
        color: #dc3545;
        margin-top: 20px;
    }
</style>

<main class="container" style="margin-top: 80px;">
    <div class="container my-4">
        <div class="search-box">
            <x-search-box search-route="{{ route('tour.index') }}" placeholder="Search Tour..." />
        </div>

        @if (request('search'))
            <p class="text-center mt-3 text-dark">Search results for: <strong>{{ request('search') }}</strong></p>
        @endif

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            @if ($tours->isNotEmpty())
                @foreach($tours as $tour)
                    <div class="col">
                        <div class="card shadow-sm">
                            <figure>
                                <a href="{{ route('tour.show', $tour->id) }}">
                                    @if ($tour->image)
                                        <img src="{{ asset('storage/' . $tour->image) }}" alt="Tour Image" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('path/to/default-image.png') }}" alt="Default Image" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                                    @endif
                                </a>
                            </figure>
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('tour.show', $tour->id) }}">{{ $tour->packageName }}</a></h5>
                                <p class="text-muted">{{ \Str::limit($tour->description, 100) }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Price:</strong> NPR {{ $tour->ticket_price }}</li>
                                <li class="list-group-item"><strong>Duration:</strong> {{ $tour->duration }} Days</li>
                            </ul>
                            <div class="card-body text-center">
                                <a href="{{ route('tour.show', $tour->id) }}" class="btn btn-primary w-100">More Info</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="no-results">No tours available at this time.</p>
            @endif
        </div>
    </div>
</main>

<x-footer />

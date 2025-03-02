<x-header/>

<main class="container" style="margin-top: 80px;">
    <div class="container mt-5 my-4">
        <h1 class="text-center mb-4">Movie List</h1>
        <x-search-box search-route="{{ route('movie.index') }}" placeholder="Search movies..." />
        @if (request('search'))
            <p class="text-center">Search results for: <strong>{{ request('search') }}</strong></p>
        @endif

        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            @if ($movie->poster_url)
                                <img src="{{ asset('storage/' . $movie->poster_url) }}" alt="{{ $movie->title }}" width="100">
                            @endif
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text"><strong>Description:</strong> {{ $movie->description }}</p>
                            <p class="card-text"><strong>Released Date:</strong> {{ $movie->release_date }}</p>
                            <p class="card-text"><strong>Genre:</strong> {{ $movie->genre }}</p>
                            <p class="card-text"><strong>Director:</strong> {{ $movie->director }}</p>
                            <hr>

                            <!-- View Screenings Button -->
                            <a href="{{ route('movie.show', ['movie' => $movie->id]) }}" class="btn btn-primary w-100">
                                View Screenings
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

<x-footer/>

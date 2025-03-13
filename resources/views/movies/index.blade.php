<x-header/>

<!-- Additional custom styles -->
<style>
  .movie-card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  }
  .movie-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  }
  .card-img-top {
    height: 300px;
    object-fit: cover;
  }
  .truncate-text {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }
</style>

<main class="container" style="margin-top: 80px;">
  <div class="container mt-5 my-4">
    <h1 class="text-center mb-4">Movie List</h1>
    <x-search-box search-route="{{ route('movie.index') }}" placeholder="Search movies..." class="mb-4" />
    @if (request('search'))
      <p class="text-center fst-italic text-muted">Search results for: <strong>{{ request('search') }}</strong></p>
    @endif

    <div class="row g-4">
      @foreach ($movies as $movie)
        <div class="col-md-4">
          <div class="card h-100 movie-card border-0 rounded" 
               style="background-image: url('{{ asset('storage/' . $movie->poster_url) }}'); background-size: cover; background-position: center; height: 400px;">
    
            <div class="card-body d-flex flex-column text-white" style="background-color: rgba(0, 0, 0, 0.5); height: 100%;">
              <h5 class="card-title">{{ $movie->title }}</h5>
              <p class="card-text truncate-text" title="{{ $movie->description }}">
                <strong>Description:</strong> {{ $movie->description }}
              </p>
              <p class="card-text"><strong>Released Date:</strong> {{ $movie->release_date }}</p>
              <p class="card-text"><strong>Genre:</strong> {{ $movie->genre }}</p>
              <p class="card-text"><strong>Director:</strong> {{ $movie->director }}</p>
              <div class="mt-auto">
                <a href="{{ route('movie.show', ['movie' => $movie->id]) }}" class="btn btn-primary w-100">
                  View Screenings
                </a>
              </div>
            </div>
    
          </div>
        </div>
      @endforeach
    </div>
    
  </div>
</main>

<x-footer/>

<x-header/>
<!-- Custom Styles for the Events Page -->
<style>
  .event-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
  }
  .truncate-text {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }
  .card-img-top {
    height: 200px;
    object-fit: cover;
  }
</style>

<main class="container" style="margin-top: 80px;">
  <div class="container my-4">
    <h1 class="text-center mb-4">Events</h1>
    
    <!-- Search Box -->
    <x-search-box search-route="{{ route('event.index') }}" placeholder="Search events..." class="mb-4"/>
    @if (request('search'))
      <p class="text-center fst-italic text-muted">Search results for: <strong>{{ request('search') }}</strong></p>
    @endif

    <div class="row g-4 mt-4">
      @foreach($events as $event)
        <div class="col-md-4">
          <div class="card event-card h-100 border-0 rounded shadow-sm" 
               style="background-image: url('{{ isset($event->image) ? asset('storage/' . $event->image) : '' }}'); background-size: cover; background-position: center; height: 400px;">
    
            <div class="card-body d-flex flex-column text-white" style="background-color: rgba(0, 0, 0, 0.5); height: 100%;">
              <h5 class="card-title">{{ $event->title }}</h5>
              <p class="card-text truncate-text" title="{{ $event->description }}">{{ $event->description }}</p>
              <p class="card-text"><strong>Date:</strong> {{ $event->event_date }}</p>
              <p class="card-text"><strong>Venue:</strong> {{ $event->venue }}</p>
              <p class="card-text"><strong>Price:</strong> ${{ $event->ticket_price }}</p>
              <div class="mt-auto">
                <a href="{{ route('booking.create', ['bookable_id' => $event->id, 'bookable_type' => get_class($event)]) }}" class="btn btn-primary w-100">
                  Book Now
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

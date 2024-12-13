<x-header/>

    <main class="container" style="margin-top: 80px;">
    <div class="container mt-5 my-4">
        <h1 class="text-center mb-4">Movie List</h1>
        <x-search-box search-route="{{ route('movie.index') }}" placeholder="Search events..." />

        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text"><strong>Description:</strong> {{ $movie->description }}</p>
                            <p class="card-text"><strong>Released Date:</strong> {{ $movie->release_date }}</p>
                            <p class="card-text"><strong>Genre:</strong> {{ $movie->genre }}</p>
                            <p class="card-text"><strong>Director:</strong> {{ $movie->director }}</p>
                            <hr>
                            <h6>Screenings:</h6>
                            <ul class="list-group">
                                @foreach ($movie->screenings as $screening)
                                    <li class="list-group-item">
                                        <strong>Cinema:</strong> {{ $screening->cinema }}<br>
                                        <strong>Show Time:</strong> {{ $screening->show_time }}<br>
                                        <strong>Price:</strong> ${{ $screening->ticket_price }}<br>
                                        <strong>Total Seats:</strong> {{ $screening->total_seats }}
                                        <div class="mt-2">
                                       
                                            <button class="btn btn-primary btn-lg" data-bs-toggle="popover" title="Book Seats">
                                                
                                                <a href="{{ route('booking.create', ['bookable_id' => $screening->id, 'bookable_type' => get_class($screening)]) }}">
                                                    Book Now
                                                </a>
                                                
                                                
                                              </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
           @endforeach
        </div>
    </div>
    </main>
<x-footer/>
    


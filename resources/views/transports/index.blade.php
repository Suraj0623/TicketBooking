<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


<h2>Buses</h2>
          @if($buses->isNotEmpty())
        @foreach ($buses as $bus)
        <div class="card w-50">
            <div class="card-body">
              <h5 class="card-title"> {{$bus->name}} </h5>
              <p class="card-text">{{$bus->capacity}} </p>
              <a href="{{ route('booking.create', ['bookable_id' => $bus->id, 'bookable_type' => get_class($bus)]) }}" class="btn btn-primary">Book Now</a>
            </div>
          </div>
          @endforeach
       
          
          @endif

          <h2>Trains</h2>
          @if($trains->isNotEmpty())
              @foreach ($trains as $train)
              <div class="card w-50">
                  <div class="card-body">
                      <h5 class="card-title">{{ $train->name }}</h5>
                      <p class="card-text">{{ $train->capacity }}</p>
                      <a href="{{ route('booking.create', ['bookable_id' => $train->id, 'bookable_type' => get_class($train)]) }}" class="btn btn-primary">Book Now</a>
                  </div>
              </div>
              @endforeach
          @else
              <p>No trains available for this route at this time.</p>
          @endif
          


<h2>Planes</h2>
          @if($planes->isNotEmpty())
        @foreach ($planes as $plane)
        <div class="card w-50">
            <div class="card-body">
              <h5 class="card-title"> {{$plane->name}} </h5>
              <p class="card-text">{{$plane->capacity}} </p>
              <a href="{{ route('booking.create', ['bookable_id' => $plane->id, 'bookable_type' => get_class($plane)]) }}" class="btn btn-primary">Book Now</a>
            </div>
          </div>
          @endforeach
          @else
          <p>No planes available for this route at this time.</p>
          @endif

         
        
          
          
          
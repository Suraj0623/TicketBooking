<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

{{-- <button class="btn btn-primary mb-3"> <a href="{{route('bus.create')}}"> Add new bus</a></button> --}}
All bus
        @foreach ($busTransport as $bus)
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $bus->name }}</h5>
              <p class="card-text">{{$bus->capacity}}</p>
              <a href="#" class="btn btn-primary">Book Now</a>
            </div>
          </div>
          @endforeach
All Train
@foreach ($trainTransport as $bus)
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $bus->name }}</h5>
              <p class="card-text">{{$bus->capacity}}</p>
              <a href="#" class="btn btn-primary">Book Now</a>
            </div>
          </div>
          @endforeach
All Plane
@foreach ($planeTransport as $bus)
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $bus->name }}</h5>
              <p class="card-text">{{$bus->capacity}}</p>
              <a href="#" class="btn btn-primary">Book Now</a>
            </div>
          </div>
          @endforeach
         
        
  
  

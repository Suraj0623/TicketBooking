<x-header/>
 
 <main class="container my-5 pt-5">
     <div class="row">
         <div class="col-md-8">
             <div class="card">
                 <figure>
                     @if ($tour->image)
                         <img src="{{ asset('storage/'.$tour->image) }}" alt="Tour Image" class="card-img-top" style="width: 100%; height: 400px; object-fit: cover;">
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
                 <div class="col-md-4"><div class="mt-auto">
                    <a href="{{ route('booking.create', ['bookable_id' => $tour->id, 'bookable_type' => get_class($tour)]) }}" class="btn btn-primary w-100">
                      Book Now
                    </a>
                  </div>
             </div>
         </div>
 
         
            
     </div>
 </main>
 
 <x-footer/>
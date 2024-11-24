
@extends('layouts.app')

@section('title', 'Our Tours')

@section('content')
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Loop through the tours array passed to the view -->
            @foreach($tours as $tour)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <!-- Tour Image -->
                        <figure>
                            <a href="{{ route('tour.show', $tour->id) }}">
                                @if ($tour->image)
                                    {{-- Apply the object-fit property to cover the container --}}
                                    <img src="{{ asset('/storage/'.$tour->image) }}" alt="User Image" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('path/to/default-image.png') }}" alt="Default Image" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                                @endif
                            </a>
                        </figure>

                        <!-- Tour Details -->
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('tour.show', $tour->id) }}">{{ $tour->packageName }}</a>
                            </h5>
                            <p class="text-muted">
                                {{ \Str::limit($tour->description, 150) }}
                                @if(strlen($tour->description) > 150)
                                    <a href="{{ route('tour.show', $tour->id) }}">... Read More</a>
                                @endif
                            </p>
                        </div>

                        <!-- Tour Information List -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Price:</strong> NPR {{ $tour->ticketPrice }}</li>
                            <li class="list-group-item"><strong>Duration:</strong> {{ $tour->duration }} Days</li>
                            <li class="list-group-item"><strong>Highlights:</strong> {{ \Str::limit($tour->highlights, 60) }}</li>
                        </ul>

                        <!-- Tour Rating & Booking -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>{{ $tour->avg_rating }}</strong> - {{ $tour->total_rating }} Reviews
                                </div>
                                <div>
                                    <strong>NPR {{ $tour->ticketPrice }}</strong> /person
                                </div>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <a href="{{ route('tour.show', $tour->id) }}" class="card-link">More Info</a>
                            {{-- <a href="{{ route('tour.book', $tour->id) }}" class="card-link">Book Now</a> --}}
                            <form action="{{route('booking.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="tour_package_id" value="{{ $tour->id }}">
                                <input type="hidden" name="booking_date" value="{{ now() }}">
                                <a href="{{ route('booking.create') }}" class="btn btn-primary">Book Now</a>
                            </form>
                            
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

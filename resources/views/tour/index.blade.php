@extends('layouts.search')

@section('title', 'Our Tours')

@section('content')
<div class="container my-4">
    <x-search-box search-route="{{ route('tour.index') }}" placeholder="Search events..." />

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($tours as $tour)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <figure>
                        <a href="{{ route('tour.show', $tour->id) }}">
                            @if ($tour->image)
                                <img src="{{ asset('/storage/'.$tour->image) }}" alt="Tour Image" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('path/to/default-image.png') }}" alt="Default Image" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                            @endif
                        </a>
                    </figure>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('tour.show', $tour->id) }}">{{ $tour->packageName }}</a></h5>
                        <p class="text-muted">{{ \Str::limit($tour->description, 150) }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Price:</strong> NPR {{ $tour->ticketPrice }}</li>
                        <li class="list-group-item"><strong>Duration:</strong> {{ $tour->duration }} Days</li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('tour.show', $tour->id) }}" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Recommended for You</h1>

    @if ($recommendations->isEmpty())
        <p>No recommendations available at this time.</p>
    @else
        <div class="recommendations">
            @foreach ($recommendations as $item)
                <div class="item">
                    <h3>{{ $item->title ?? $item->name }}</h3>
                    <p>{{ $item->description }}</p>
                    <p><strong>Category:</strong> {{ $item->category ?? $item->genre }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection
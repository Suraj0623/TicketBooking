@extends('layouts.admin')

@section('title', 'Edit Tour')

@section('content')
    <div class="container">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<h1>Edit Tour</h1>
<form action="{{ route('tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Use PUT method for updates -->

    <div class="form-group">
        <label for="title">Tour Name</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $tour->title) }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description', $tour->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
        @if ($tour->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $tour->image) }}" alt="Current Image" style="max-width: 100px;">
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="packageName">Package Name</label>
        <input type="text" class="form-control" name="packageName" id="packageName" value="{{ old('packageName', $tour->packageName) }}" required>
    </div>

    <div class="form-group">
        <label for="ticket_price">Price Per Person</label>
        <input type="number" class="form-control" name="ticket_price" id="ticket_price" step="0.01" value="{{ old('ticket_price', $tour->ticket_price) }}" required>
    </div>

    <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" class="form-control" name="duration" id="duration" value="{{ old('duration', $tour->duration) }}" required>
    </div>

    <div class="form-group">
        <label for="highlights">Highlights</label>
        <textarea class="form-control" name="highlights" id="highlights" rows="3" required>{{ old('highlights', $tour->highlights) }}</textarea>
    </div>

    <div class="form-group">
        <label for="capacity">Total Person Per Package</label>
        <input type="number" class="form-control" name="capacity" id="capacity" step="0.1" value="{{ old('capacity', $tour->capacity) }}" required>
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" name="category" id="category" value="{{ old('category', $tour->category) }}" required>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-primary">Update Tour</button>
        <a href="{{ route('tours.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
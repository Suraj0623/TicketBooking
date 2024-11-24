@extends('layouts.app')

@section('title', 'Edit Tour')

@section('content')
    <h1>Edit Tour</h1>

    <!-- Form to update the tour -->
    <form action="{{ route('tour.update', $tour->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This tells Laravel to use the PUT method for updating -->

        <div class="form-group">
            <label for="name">Tour Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $tour->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description', $tour->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" name="image" id="image" value="{{ old('image', $tour->image) }}" required>
        </div>

        <div class="form-group">
            <label for="packageName">Package Name</label>
            <input type="text" class="form-control" name="packageName" id="packageName" value="{{ old('packageName', $tour->packageName) }}" required>
        </div>

        <div class="form-group">
            <label for="ticketPrice">Ticket Price</label>
            <input type="number" class="form-control" name="ticketPrice" id="ticketPrice" value="{{ old('ticketPrice', $tour->ticketPrice) }}" required>
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
            <label for="avg_rating">Average Rating</label>
            <input type="number" class="form-control" name="avg_rating" id="avg_rating" value="{{ old('avg_rating', $tour->avg_rating) }}" step="0.1" required>
        </div>

        <div class="form-group">
            <label for="total_rating">Total Rating</label>
            <input type="number" class="form-control" name="total_rating" id="total_rating" value="{{ old('total_rating', $tour->total_rating) }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Tour</button>
    </form>
@endsection

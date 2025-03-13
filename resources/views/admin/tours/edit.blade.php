@extends('layouts.admin')

@section('title', 'Edit Tour')

@section('content')
    <div class="container">
        <h1>Edit Tour</h1>
        <!-- Form to update the tour -->
        <form action="{{ route('tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <!-- Tour Name -->
            <div class="form-group">
                <label for="title">Tour Name</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $tour->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description', $tour->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image -->
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
                @if ($tour->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}" style="max-width: 100px;">
                    </div>
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Package Name -->
            <div class="form-group">
                <label for="packageName">Package Name</label>
                <input type="text" class="form-control" name="packageName" id="packageName" value="{{ old('packageName', $tour->packageName) }}" required>
                @error('packageName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ticket Price -->
            <div class="form-group">
                <label for="ticket_price">Ticket Price</label>
                <input type="number" class="form-control" name="ticket_price" id="ticket_price" value="{{ old('ticket_price', $tour->ticket_price) }}" step="0.01" required>
                @error('ticket_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Duration -->
            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" name="duration" id="duration" value="{{ old('duration', $tour->duration) }}" required>
                @error('duration')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Highlights -->
            <div class="form-group">
                <label for="highlights">Highlights</label>
                <textarea class="form-control" name="highlights" id="highlights" rows="3" required>{{ old('highlights', $tour->highlights) }}</textarea>
                @error('highlights')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" name="category" id="category" value="{{ old('category', $tour->category) }}" required>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-3">Update Tour</button>
        </form>
    </div>
@endsection
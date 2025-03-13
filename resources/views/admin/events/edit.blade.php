@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Event</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" class="form-control" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Event Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="total_seats">Total Seats</label>
                <input type="number" name="total_seats" id="total_seats" value="{{ old('total_seats', $event->total_seats) }}" class="form-control" min="1" step="1">
                @error('total_seats')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Event Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="mt-2" width="100">
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" name="event_date" id="event_date" value="{{ old('event_date', $event->event_date) }}" class="form-control" required>
                @error('event_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="venue">Event Venue</label>
                <input type="text" name="venue" id="venue" value="{{ old('venue', $event->venue) }}" class="form-control" required>
                @error('venue')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="col-md-6">
                <label for="category" class="form-label">Category</label>
                <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $event->category) }}">
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ticket_price">Ticket Price</label>
                <input type="number" name="ticket_price" id="ticket_price" value="{{ old('ticket_price', $event->ticket_price) }}" class="form-control" step="0.01" required>
                @error('ticket_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Event</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

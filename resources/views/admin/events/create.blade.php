@extends('layouts.admin')

@section('title', 'Add New Event')

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Event</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Event Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="total_seats">Total Seats</label>
                <input type="number" name="total_seats" id="total_seats" class="form-control" min="1" step="1">
                @error('total_seats')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Event Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" name="event_date" id="event_date" class="form-control" required>
                @error('event_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="venue">Event Venue</label>
                <input type="text" name="venue" id="venue" class="form-control" required>
                @error('venue')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
             <!-- Category -->
             <div class="col-md-6">
                <label for="category" class="form-label">Category</label>
                <input type="text" id="category" name="category" class="form-control" value="{{ old('category') }}">
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ticket_price">Ticket Price</label>
                <input type="number" name="ticket_price" id="ticket_price" class="form-control" step="0.01" required>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit Button -->
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Event</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        

           

           
    </div>
@endsection
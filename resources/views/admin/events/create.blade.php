@extends('layouts.admin')

@section('title', 'Add New Event')

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Event</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('events.store') }}" method="POST" class="row g-3">
            @csrf

            <!-- Title -->
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

               <!-- Image -->
               <div class="col-md-6">
                <label for="image" class="form-label">Event Photos</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Event Date -->
            <div class="col-md-6">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="datetime-local" id="event_date" name="event_date" class="form-control" value="{{ old('event_date') }}">
                @error('event_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Venue -->
            <div class="col-md-6">
                <label for="venue" class="form-label">Venue</label>
                <input type="text" id="venue" name="venue" class="form-control" value="{{ old('venue') }}">
                @error('venue')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ticket Price -->
            <div class="col-md-6">
                <label for="ticket_price" class="form-label">Ticket Price</label>
                <input type="number" id="ticket_price" name="ticket_price" step="0.01" class="form-control" value="{{ old('ticket_price') }}">
                @error('ticket_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total Seats -->
            <div class="col-md-6">
                <label for="total_seats" class="form-label">Total Seats</label>
                <input type="number" id="total_seats" name="total_seats" class="form-control" value="{{ old('total_seats') }}">
                @error('total_seats')
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

            <!-- Submit Button -->
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Event</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
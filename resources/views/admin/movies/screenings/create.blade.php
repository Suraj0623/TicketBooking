@extends('layouts.moviesScreen')

@section('title', 'Add New Screening')

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Screening</h1>
        <form action="{{ route('screenings.store') }}" method="POST" class="row g-3">
            @csrf

            <!-- Movie Selection -->
            <div class="col-md-6">
                <label for="movie_id" class="form-label">Movie</label>
                <select name="movie_id" id="movie_id" class="form-select" required>
                    <option value="" disabled {{ !request('movie_id') ? 'selected' : '' }}>Select a Movie</option>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
                @error('movie_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Cinema -->
            <div class="col-md-6">
                <label for="cinema" class="form-label">Cinema</label>
                <input type="text" name="cinema" id="cinema" class="form-control" value="{{ old('cinema') }}" required>
                @error('cinema')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Show Time -->
            <div class="col-md-6">
                <label for="show_time" class="form-label">Show Time</label>
                <input type="datetime-local" name="show_time" id="show_time" class="form-control" value="{{ old('show_time') }}" required>
                @error('show_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ticket Price -->
            <div class="col-md-6">
                <label for="ticket_price" class="form-label">Ticket Price</label>
                <input type="number" step="0.01" name="ticket_price" id="ticket_price" class="form-control" value="{{ old('ticket_price') }}" required>
                @error('ticket_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total Seats -->
            <div class="col-md-6">
                <label for="total_seats" class="form-label">Total Seats</label>
                <input type="number" name="total_seats" id="total_seats" class="form-control" value="{{ old('total_seats') }}" required>
                @error('total_seats')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Add Screening</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.moviesScreen')

@section('title', 'Edit Movie')

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Movie</h1>
        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $movie->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Release Date -->
            <div class="col-md-6">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', $movie->release_date) }}">
                @error('release_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Genre -->
            <div class="col-md-6">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre', $movie->genre) }}">
                @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Director -->
            <div class="col-md-6">
                <label for="director" class="form-label">Director</label>
                <input type="text" name="director" id="director" class="form-control" value="{{ old('director', $movie->director) }}">
                @error('director')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Poster -->
            <div class="col-md-6">
                <label for="poster" class="form-label">Poster</label>
                <input type="file" name="poster" id="poster" class="form-control">
                @if ($movie->poster_url)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $movie->poster_url) }}" alt="{{ $movie->title }}" style="max-width: 100px;">
                    </div>
                @endif
                @error('poster')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Movie</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.moviesScreen')

@section('title', 'Add New Movie')

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Movie</h1>
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <!-- Title -->
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Image -->
            <div class="col-md-6">
                <label for="poster_url" class="form-label">Movie Poster</label>
                <input type="file" name="poster_url" id="poster_url" class="form-control" accept="image/*">
                @error('poster')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            


            <!-- Release Date -->
            <div class="col-md-6">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date') }}">
                @error('release_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Genre -->
            <div class="col-md-6">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') }}">
                @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Director -->
            <div class="col-md-6">
                <label for="director" class="form-label">Director</label>
                <input type="text" name="director" id="director" class="form-control" value="{{ old('director') }}">
                @error('director')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- <!-- Poster -->
            <div class="col-md-6">
                <label for="poster" class="form-label">Poster</label>
                <input type="file" name="poster" id="poster" class="form-control">
                @error('poster')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            <!-- Submit and Cancel Buttons -->
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Add Movie</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
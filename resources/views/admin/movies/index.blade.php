@extends('layouts.moviesScreen')

@section('title', 'All Movies')

@section('content')
    <div class="container">
        <h1 class="mt-4">Movies</h1>
        <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Add New Movie</a>
        <a href="{{ route('dashboardPage') }}" class="btn btn-primary mb-3">Go Back</a>
        <a href="{{ route('screenings.index') }}" class="btn btn-primary mb-3">View Screenings</a>


        <!-- Movies Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Director</th>
                    <th>Release Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->genre }}</td>
                        <td>{{ $movie->director }}</td>
                        <td>{{ $movie->release_date }}</td>
                        <td>
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
                            </form>
                            <a href="{{ route('screenings.create', ['movie_id' => $movie->id]) }}" class="btn btn-sm btn-success">Add Screening</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
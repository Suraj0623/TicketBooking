<x-layout title="Movies">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <h1>Movies</h1>
    <a href="{{ route('movies.create') }}">Add Movie</a>
    <ul>
        @foreach ($movies as $movie)
            <li>
                <strong>{{ $movie->title }}</strong> - {{ $movie->genre }}
                <a href="{{ route('movie.edit', $movie) }}">Edit</a>
                <form action="{{ route('movie.destroy', $movie) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

</x-layout>
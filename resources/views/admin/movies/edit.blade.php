<x-layout title="Movies">
    <h1>Edit Movie</h1>
    <form action="{{ route('movies.update', $movie) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Title: <input type="text" name="title" value="{{ $movie->title }}"></label>
        <label>Description: <textarea name="description">{{ $movie->description }}</textarea></label>
        <label>Release Date: <input type="date" name="release_date" value="{{ $movie->release_date }}"></label>
        <label>Genre: <input type="text" name="genre" value="{{ $movie->genre }}"></label>
        <label>Director: <input type="text" name="director" value="{{ $movie->director }}"></label>
        <button type="submit">Save</button>
    </form>

</x-layout>
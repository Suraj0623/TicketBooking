<x-layout title="Movies">
    <h1>Add Movie</h1>
    <form action="{{ route('movies.store') }}" method="POST">
        @csrf
        <label>Title: <input type="text" name="title"></label>
        <label>Description: <textarea name="description"></textarea></label>
        <label>Release Date: <input type="date" name="release_date"></label>
        <label>Genre: <input type="text" name="genre"></label>
        <label>Director: <input type="text" name="director"></label>
        <button type="submit">Save</button>
    </form>

</x-layout>
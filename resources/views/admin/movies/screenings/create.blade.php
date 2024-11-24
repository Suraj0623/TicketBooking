<x-layout title="Screenings">
    <h1>Add Screening</h1>
    <form action="{{ route('screenings.store') }}" method="POST">
        @csrf
        <label>Movie:
            <select name="movie_id">
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                @endforeach
            </select>
        </label>
        <label>Cinema: <input type="text" name="cinema"></label>
        <label>Show Time: <input type="datetime-local" name="show_time"></label>
        <label>Ticket Price: <input type="number" step="0.01" name="ticket_price"></label>
        <label>Total Seats: <input type="number" name="total_seats"></label>
        <button type="submit">Save</button>
    </form>
</x-layout>

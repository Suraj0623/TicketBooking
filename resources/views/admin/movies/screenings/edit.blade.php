<x-layout title="Screenings">
    <h1>Edit Screening</h1>
    <form action="{{ route('screenings.update', $screening) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Movie:
            <select name="movie_id">
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}" {{ $screening->movie_id == $movie->id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
        </label>
        <label>Cinema: <input type="text" name="cinema" value="{{ $screening->cinema }}"></label>
        <label>Show Time: <input type="datetime-local" name="show_time" value="{{ $screening->show_time }}"></label>
        <label>Ticket Price: <input type="number" step="0.01" name="ticket_price" value="{{ $screening->ticket_price }}"></label>
        <label>Total Seats: <input type="number" name="total_seats" value="{{ $screening->total_seats }}"></label>
        <button type="submit">Save</button>
    </form>
</x-layout>

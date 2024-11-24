<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <h1>Create Event</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}">
        @error('title') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        @error('description') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="event_date">Event Date:</label>
        <input type="datetime-local" id="event_date" name="event_date" value="{{ old('event_date') }}">
        @error('event_date') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" value="{{ old('venue') }}">
        @error('venue') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="ticket_price">Ticket Price:</label>
        <input type="number" id="ticket_price" name="ticket_price" step="0.01" value="{{ old('ticket_price') }}">
        @error('ticket_price') <p style="color: red;">{{ $message }}</p> @enderror

        <label for="total_seats">Total Seats:</label>
        <input type="number" id="total_seats" name="total_seats" value="{{ old('total_seats') }}">
        @error('total_seats') <p style="color: red;">{{ $message }}</p> @enderror


        <button type="submit">Create Event</button>
    </form>
</body>
</html>

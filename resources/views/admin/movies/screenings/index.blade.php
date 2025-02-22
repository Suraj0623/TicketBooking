@extends('layouts.moviesScreen')

@section('title', 'All Screenings')

@section('content')
    <div class="container">
        <h1 class="mt-4">Screenings</h1>
        <a href="{{ route('screenings.create') }}" class="btn btn-primary mb-3">Add Screening</a>

        <!-- Screenings Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Movie Title</th>
                    <th>Cinema</th>
                    <th>Show Time</th>
                    <th>Ticket Price</th>
                    <th>Total Seats</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($screenings as $screening)
                    <tr>
                        <td>{{ $screening->id }}</td>
                        <td>{{ $screening->movie->title }}</td>
                        <td>{{ $screening->cinema }}</td>
                        <td>{{ $screening->show_time }}</td>
                        <td>${{ number_format($screening->ticket_price, 2) }}</td>
                        <td>{{ $screening->total_seats }}</td>
                        <td>
                            <a href="{{ route('screenings.edit', $screening) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('screenings.destroy', $screening) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this screening?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
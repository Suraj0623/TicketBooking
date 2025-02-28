@extends('layouts.admin')

@section('title', 'All Events')

@section('content')


    <div class="container">

       <h1 class="mt-4">Events</h1>
       <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Add New Event</a>
       <a href="{{ route('dashboardPage') }}" class="btn btn-primary mb-3">Go Back</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Price (NPR)</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $key => $event)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ Str::limit($event->description, 50) }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{{ $event->venue }}</td>
                    <td>${{ $event->ticket_price }}</td>
                    <td>{{ $event->category }}</td>
                    <td>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
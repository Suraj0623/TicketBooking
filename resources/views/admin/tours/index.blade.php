@extends('layouts.admin')

@section('title', 'All Tours')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h1 class="mt-4">All Tours</h1>
    <a href="{{ route('tours.create') }}" class="btn btn-primary mb-3">Add New Tour</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Ticket Price (NPR)</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tours as $key => $tour)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $tour->name }}</td>
                    <td>
                        <img src="{{ asset('/storage/'.$tour->image) }}" class="img-thumbnail" style="width: 100px; height: 70px;" alt="{{ $tour->name }}">
                    </td>
                    <td>{{ Str::limit($tour->description, 50) }}</td>
                    <td>{{ $tour->price }}</td>
                    <td>{{ $tour->duration }}</td>
                    <td>
                        <a href="{{ route('tour.show', $tour->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('tour.edit', $tour->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tour.destroy', $tour->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

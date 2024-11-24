@extends('layouts.admin')
@section('content')
    


<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Button to Add New Transport -->
<button class="btn btn-primary mb-3"> 
    <a href="{{ route('transports.create') }}" class="text-white text-decoration-none">Add New Transport</a>
</button>
<!-- For Bus -->
<h1>For Bus</h1>
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Bus Name</th>
            <th>Capacity</th>
            <th>Route</th>
            <th>Price Per Seat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($busTransport as $bus)
        <tr>
            <td>{{ $bus->name }}</td>
            <td>{{ $bus->capacity }}</td>
            <td>{{ $bus->route->origin }} to {{ $bus->route->destination }}</td>
            <td>{{ $bus->price_per_seat }}</td>
            <td>
                <a href="{{ route('transports.edit', $bus->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('transports.destroy', $bus->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- For Train -->
<h1>For Train</h1>
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Train Name</th>
            <th>Capacity</th>
            <th>Route</th>
            <th>Price Per Seat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trainTransport as $train)
        <tr>
            <td>{{ $train->name }}</td>
            <td>{{ $train->capacity }}</td>
            <td>{{ $train->route->origin }} to {{ $train->route->destination }}</td>
            <td>{{ $train->price_per_seat }}</td>
            <td>
                <a href="{{ route('transports.edit', $train->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('transports.destroy', $train->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- For Plane -->
<h1>For Plane</h1>
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Plane Name</th>
            <th>Capacity</th>
            <th>Route</th>
            <th>Price Per Seat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($planeTransport as $plane)
        <tr>
            <td>{{ $plane->name }}</td>
            <td>{{ $plane->capacity }}</td>
            <td>{{ $plane->route->origin }} to {{ $plane->route->destination }}</td>
            <td>{{ $plane->price_per_seat }}</td>
            <td>
                <a href="{{ route('transports.edit', $plane->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('transports.destroy', $plane->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


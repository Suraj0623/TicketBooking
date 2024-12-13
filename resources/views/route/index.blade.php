<!-- Button to Add New Route -->
<a href="{{ route('route.create') }}" class="btn btn-primary mb-3">Add New Route</a>

<!-- Table to Display Routes -->
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Origin</th>
            <th>Destination</th>
            <th>Total Time (in hours) </th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($routes as $route)
        <tr>
            <td>{{ $route->origin }}</td>
            <td>{{ $route->destination }}</td>
            <td>{{ $route->duration }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

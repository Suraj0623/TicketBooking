
<x-header/>
    <div class="container bg-light p-4 rounded shadow-sm">
        <h1 class="mb-4 text-primary">Search Results</h1>

        <p class="text-muted">Results for: <strong>{{ $query }}</strong> in category: <strong>{{ $category }}</strong></p>

        @if(isset($results) && $results->count() > 0)
            <div class="table-responsive bg-white p-3 rounded">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $index => $result)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $result->name }}</td>
                                <td>{{ $result->category }}</td>
                                <td>{{ Str::limit($result->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('details.view', $result->id) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">No results found for your search.</div>
        @endif
    </div>
    <x-footer/>





<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h2>Create New Route</h2>
    <form action="{{ route('route.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="origin">Origin:</label>
            <input type="text" name="origin" id="origin" class="form-control" value="{{ old('origin') }}" required>
            @error('origin')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="destination">Destination:</label>
            <input type="text" name="destination" id="destination" class="form-control" value="{{ old('destination') }}" required>
            @error('destination')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="duration">Duration (in hours):</label>
            <input type="text" name="duration" id="duration" class="form-control" value="{{ old('duration') }}" required>
            @error('duration')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Route</button>
    </form>
</div>


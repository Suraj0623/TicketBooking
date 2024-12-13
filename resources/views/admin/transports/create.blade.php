<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container">
        <h2>Create New Transport</h2>

        <form action="{{ route('transports.store') }}" method="POST">
            @csrf

            <!-- Route Selection -->
            <div class="form-group">
                <label for="route_id">Route:</label>
                <select name="route_id" id="route_id" class="form-control" required>
                    <option value="">Select Route</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                            {{ $route->origin }} to {{ $route->destination }}
                        </option>
                    @endforeach
                </select>
                @error('route_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Transport Type -->
            <div class="form-group">
                <label for="type">Transport Type:</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="bus" {{ old('type') == 'bus' ? 'selected' : '' }}>Bus</option>
                    <option value="plane" {{ old('type') == 'plane' ? 'selected' : '' }}>Plane</option>
                    <option value="train" {{ old('type') == 'train' ? 'selected' : '' }}>Train</option>
                </select>
                @error('type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Vehicle Name -->
            <div class="form-group">
                <label for="name">Company Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

           <!-- Departure Date -->
            <div class="form-group">
                <label for="departure_date">Departure Date:</label>
                <input type="date" name="departure_date" id="departure_date" class="form-control" value="{{ old('departure_date') }}" required>
                @error('departure_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Departure Time -->
            <div class="form-group">
                <label for="departure_time">Departure Time:</label>
                <input type="time" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time') }}" required>
                @error('departure_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Capacity -->
            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity') }}" required min="1">
                @error('capacity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price per Seat -->
            <div class="form-group">
                <label for="ticket_price">Price per Seat:</label>
                <input type="number" name="ticket_price" id="ticket_price" class="form-control" value="{{ old('ticket_price') }}" required min="0" step="0.01">
                @error('ticket_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Create Transport</button>
        </form>
    </div>


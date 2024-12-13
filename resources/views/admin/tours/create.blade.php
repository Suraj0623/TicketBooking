

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <h1>Create New Tour</h1>

    <form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tour Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image" required>
        </div>
        <div class="form-group">
            <label for="packageName">Package Name</label>
            <input type="text" class="form-control" name="packageName" id="packageName" required>
        </div>
        <div class="form-group">
            <label for="ticket_price">Price Per Person</label>
            <input type="number" class="form-control" name="ticket_price" id="ticket_price" required>
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" class="form-control" name="duration" id="duration" required>
        </div>
        <div class="form-group">
            <label for="highlights">Highlights</label>
            <textarea class="form-control" name="highlights" id="highlights" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="avg_rating">Average Rating</label>
            <input type="number" class="form-control" name="avg_rating" id="avg_rating" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="total_rating">Total Rating</label>
            <input type="number" class="form-control" name="total_rating" id="total_rating" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Tour</button>
    </form>


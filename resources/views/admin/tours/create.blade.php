<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<h1>Create New Tour</h1>
<form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Tour Name</label>
        <input type="text" class="form-control" name="title" id="title" required>
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
        <input type="number" class="form-control" name="ticket_price" id="ticket_price" step="0.01" required>
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
        <label for="capacity">Total Person Per Package</label>
        <input type="number" class="form-control" name="capacity" id="capacity" step="0.1" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" name="category" id="category" required>
    </div>
    <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-primary">Create Tour</button>
        <a href="{{ route('tours.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
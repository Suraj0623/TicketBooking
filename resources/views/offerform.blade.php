<!-- resources/views/offers/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Offer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New Offer</h2>
        <!-- Form for creating a new offer -->
        <form action="{{ route('offer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  <!-- CSRF token for security -->
            
            <!-- Offer Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Offer Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            
            <!-- Expiration Date -->
            <div class="mb-3">
                <label for="expiration_date" class="form-label">Expiration Date</label>
                <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
            </div>
            
            <!-- Offer Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Offer Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            
            <!-- Coupon Code -->
            <div class="mb-3">
                <label for="coupon_code" class="form-label">Coupon Code</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
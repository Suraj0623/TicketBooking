<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Your Profile</h1>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update', ['profile' => $profile->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="FirstName" class="form-label">First Name</label>
                <input type="text" name="FirstName" class="form-control" value="{{ $profile->FirstName }}" required>
            </div>

            <div class="mb-3">
                <label for="LastName" class="form-label">Last Name</label>
                <input type="text" name="LastName" class="form-control" value="{{ $profile->LastName }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $profile->email }}" required>
            </div>

            <div class="mb-3">
                <label for="mobileNumber" class="form-label">Mobile Number</label>
                <input type="text" name="mobileNumber" class="form-control" value="{{ $profile->mobileNumber }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" name="image" class="form-control">
                @if($profile->image)
                    <img src="{{ asset('storage/' . $profile->image) }}" alt="Current Profile Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                @else
                    <p>No profile image uploaded.</p>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>

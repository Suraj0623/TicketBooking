<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<x-header/>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Profile</h1>
        <div class="card">
            <div class="card-header">
                Profile Details
            </div>
            <div class="card-body">
                <p><strong>First Name:</strong> {{ $profile->FirstName }}</p>
                <p><strong>Last Name:</strong> {{ $profile->LastName }}</p>
                <p><strong>Email:</strong> {{ $profile->email }}</p>
                <p><strong>Mobile Number:</strong> {{ $profile->mobileNumber }}</p>
                <p><strong>Image:</strong></p>
                @if($profile->image)
                    <img src="{{ asset('storage/' . $profile->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                @else
                    <p>No profile image uploaded.</p>
                @endif
            </div>
        </div>
        
        <!-- Update Button and Form -->
        <div class="mt-4">
            <a href="{{ route('profile.edit',['profile'=>$profile->id]) }}" class="btn btn-success">Update Profile</a>
            
        </div>
       
      
    </div>
    <x-footer/>

</body>
</html>

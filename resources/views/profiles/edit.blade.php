@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Your Profile</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update', ['profile' => $profile->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="mb-3">
            <label for="FirstName" class="form-label">First Name</label>
            <input type="text" name="FirstName" class="form-control" value="{{ old('FirstName', $profile->FirstName) }}" required>
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="LastName" class="form-label">Last Name</label>
            <input type="text" name="LastName" class="form-control" value="{{ old('LastName', $profile->LastName) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email) }}" required>
        </div>

        <!-- Description (Optional) -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $profile->description) }}</textarea>
        </div>

        <!-- Mobile Number -->
        <div class="mb-3">
            <label for="mobileNumber" class="form-label">Mobile Number</label>
            <input type="text" name="mobileNumber" class="form-control" value="{{ old('mobileNumber', $profile->mobileNumber) }}" required>
        </div>

        <!-- Country (Optional) -->
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" class="form-control" value="{{ old('country', $profile->country) }}">
        </div>
        <!-- province (Optional) -->
        <div class="mb-3">
            <label for="province" class="form-label">Province</label>
            <input type="text" name="province" class="form-control" value="{{ old('province', $profile->province) }}">
        </div>
        <!-- city (Optional) -->
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $profile->city) }}">
        </div>

        <!-- Hobby (Optional) -->
        <div class="mb-3">
            <label for="hobby" class="form-label">Hobby</label>
            <input type="text" name="hobby" class="form-control" value="{{ old('hobby', $profile->hobby) }}">
        </div>

       

        <!-- Profile Image -->
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
@endsection

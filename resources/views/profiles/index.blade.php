<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .list-group-item:hover {
            opacity: .9;
            background: #1B60C1 !important;
        }
        .tab_active {
            background: #1B60C1 !important;
            color: white;
            text-decoration: none;
        }
        .list-group-item:hover, .list-group-item a:hover {
            color: white !important;
        }
        .tab_active a:hover {
            opacity: .9;
        }
    </style>
</head>
<x-header/>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Profile</h1>
        <div class="row">
            
            <div class="col-lg-3 mb-3">
                <div class="bg-white shadow-sm rounded p-3">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <button class="btn btn-outline-secondary w-100" > 
                                <a href="{{ route('profile.index') }}"> Profile</a>
                               
                            </button>
                        </li>
                        <li class="mb-3">
                            <button class="btn btn-outline-secondary w-100"> <a href="">Password</a>
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-primary w-100">
                                <a href="{{route('partner')}}"> Be an Agent</a>
                               
                        </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center" style="gap: 0.5rem">
                    <i class="ti-wallet"></i>
                    <h3 class="mb-3">Profile Details</h3>
                </div>
                <div class="card">
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
                <div class="mt-4">
                    <a href="{{ route('profile.edit', ['profile' => $profile->id]) }}" class="btn btn-success">Update Profile</a>
                    <a href="{{ route('partner') }}" class="btn btn-outline-primary">Become a Partner</a>
                </div>
            </div>
        </div>
    </div>
    <x-footer/>
</body>
</html>

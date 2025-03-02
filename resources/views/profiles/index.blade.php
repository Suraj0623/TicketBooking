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

<body class="bg-light">
    <!-- Header Component -->
    <x-header/>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Profile</h1>

        <div class="row">
            <!-- Profile Details Card -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <!-- Profile Image -->
                        <img src="{{ asset('storage/' . $profile->image) }}" alt="Profile Image" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        
                        <!-- Profile Details -->
                        <h3 class="card-title">{{ $profile->FirstName }} {{ $profile->LastName }}</h3>
                        <p class="text-muted">{{ $profile->email }}</p>

                        <!-- Profile Information -->
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Mobile Number:</strong>
                                <span>{{ $profile->mobileNumber }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('profile.edit', ['profile' => $profile->id]) }}" class="btn btn-success w-48">Update Profile</a>
                    <a href="{{ route('partner') }}" class="btn btn-outline-primary w-48">Become a Partner</a>
                </div>
            </div>

            <!-- Sidebar or Other Content (optional) -->
            <div class="col-md-6">
                <!-- Additional Content can go here -->
            </div>
        </div>
    </div>

    <!-- Footer Component -->
    <x-footer/>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

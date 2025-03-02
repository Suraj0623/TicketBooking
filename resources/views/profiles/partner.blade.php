<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KYC Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        {{-- <div class="col-lg-3 mb-3">
            <div class="bg-white shadow-sm rounded p-3">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <button class="btn btn-outline-secondary w-100">Profile</button>
                    </li>
                    <li class="mb-3">
                        <button class="btn btn-outline-secondary w-100">Password</button>
                    </li>
                    <li>
                        <button class="btn btn-primary w-100">Be an Agent</button>
                    </li>
                </ul>
            </div>
        </div> --}}

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="bg-white shadow-sm rounded p-4">
                <h2 class="mb-3">KYC Form</h2>
                <h3 class="mb-3">User's Personal Details</h3>

                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="Full Name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Father Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Grandfather's Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select class="form-select">
                                <option>Select Gender</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Marital Status</label>
                            <select class="form-select">
                                <option>Select Marital Status</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nationality</label>
                            <select class="form-select">
                                <option>Nepal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="sorisshrestha53@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <h3 class="mt-4">Identity Details</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Identity Type</label>
                            <select class="form-select">
                                <option>Select Identity Type</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Identity Document Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Document Issued Date</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Document Front</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Document Back</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>

                    <h3 class="mt-4">Permanent Address</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Province</label>
                            <select class="form-select">
                                <option>Select Province</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">District</label>
                            <select class="form-select">
                                <option>Select District</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Municipality</label>
                            <select class="form-select">
                                <option>Select Municipality</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Street Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <h3 class="mt-4">Temporary Address</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Province</label>
                            <select class="form-select">
                                <option>Select Province</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <input type="checkbox" class="form-check-input me-2">
                            <label class="form-check-label">Same as Permanent Address</label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">District</label>
                            <select class="form-select">
                                <option>Select District</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Municipality</label>
                            <select class="form-select">
                                <option>Select Municipality</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Street Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                    <div class="mt-3">
                        <a href="{{route('profile.index')}}" class="btn btn-secondary w-80">Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

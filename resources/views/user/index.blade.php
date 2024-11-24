<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">User Management</h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Role</th>
                    <th>Update Role</th>
                    <th>Block User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $user)
                <tr>
                    <td>{{ $user->FirstName }}</td>
                    <td>{{ $user->LastName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobileNumber }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->roleName }}<br>
                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm">Update Role</button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm">Block</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (Optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

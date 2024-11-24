<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon (optional) -->
    <link rel="icon" href="https://bussewa.com/images/favicon/favicon.ico" type="image/x-icon">

</head>

<body style="background-image: url('{{ asset('images/forlog.png') }}'); background-size: cover; background-attachment: fixed; height: 100vh; background-position: center;">


    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg" style="width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Login to </h5>
@props([
    'action',
    'method' => 'POST'
])

<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" {{ $attributes }}>
    @csrf
    @unless(in_array($method, ['GET', 'POST']))
        @method($method)
    @endunless
    {{ $slot }}
</form>

</div>
</div>
</div>

<!-- Bootstrap JS & Popper.js (required for dropdowns and modals) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>

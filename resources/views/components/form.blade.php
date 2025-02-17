<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    

</head>

{{-- <body style="background-image: url('{{ asset('images/forlog.webp') }}'); background-size: cover; background-attachment: fixed; height: 100vh; background-position: center;"> --}}
    <body class="bg-success">


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
    <div class="text-center mt-3">
        <a href="{{route('welcome')}}" class="btn btn-lg bg-primary btn-center">Go Back</a>
    </div>
   
</form>

</div>
</div>
</div>

<!-- Bootstrap JS & Popper.js (required for dropdowns and modals) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>

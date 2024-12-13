<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home Page</title>
</head>
<body style="background-image: url('{{ asset('images/new.avif') }}'); background-size: cover; background-attachment: fixed; height: 100vh; background-position: center;" class="bg-body">
    <!-- Navigation Bar -->
    <x-header/>
    <!-- Main Content -->
    <main class="text-center text-black py-5">
        <h2>Choose A Service</h2>
        <p>Select a service to search and book available options.</p>
        <div class="container">
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-5 mb-4 ms-3">
                        <div class="card text-bg-dark w-100">
                            <img src="{{ asset($service['image']) }}" class="card-img-top" alt="{{ $service['title'] }}">
                            <div class="card-img-overlay">
                                <h5 class="card-title">{{ $service['title'] }}</h5>
                                <p class="card-text">{{ $service['description'] }}</p>
                            </div>
                        </div>
                        <a href="{{ route($service['route']) }}" class="btn btn-primary mb-3">GO</a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

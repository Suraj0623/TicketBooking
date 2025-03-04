@extends('layouts.admin')

@section('title', 'Seats Management')

@section('content')
   
            

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theatre Seating Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .seat {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .available { background-color: green; }
        .booked { background-color: red; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Theatre Seating Plan</h2>
        <p class="text-center text-muted">Red = Booked, Green = Available</p>

        <div class="d-flex justify-content-center flex-wrap">
            @foreach($seats as $seat)
                <div class="seat {{ $seat->status == 'booked' ? 'booked' : 'available' }}">
                    {{ $seat->seat_number }}
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-danger">Reset Seats</button>
        </div>
    </div>
</body>
</html>
@endsection 
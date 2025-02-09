
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Booking View</title>
    <style>
        .seat-grid {
            display: grid;
            grid-template-columns: repeat(10, 40px);
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        .seat {
            width: 40px;
            height: 40px;
            background-color: green;
            border: 1px solid #000;
            cursor: pointer;
            text-align: center;
            line-height: 40px;
            color: white;
        }
        .seat.booked {
            background-color: red;
            cursor: not-allowed;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Seat Booking System</h1>
    <div class="seat-grid" id="seatGrid">
        @foreach ($seats as $seat)
            <div 
                class="seat {{ $seat->is_booked ? 'booked' : '' }}" 
                data-seat-id="{{ $seat->id }}">
                {{ $seat->seat_number }}
            </div>
        @endforeach
    </div>

    <script>
        document.querySelectorAll('.seat').forEach(seat => {
            seat.addEventListener('click', function () {
                if (seat.classList.contains('booked')) return;

                const seatId = seat.dataset.seatId;
                const isBooked = seat.classList.toggle('booked');

                fetch(`/seats/${seatId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ is_booked: isBooked })
                }).then(response => response.json())
                  .then(data => {
                      if (!data.success) alert('Failed to book the seat');
                  });
            });
        });
    </script>
</body>
</html>
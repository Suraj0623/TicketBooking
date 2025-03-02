<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                background-color: white;
            }
            header, footer, .btn {
                display: none;
            }
            .ticket-details {
                border: none;
                padding: 10px;
                background-color: white;
                box-shadow: none;
            }
            h1 {
                font-size: 28px;
                text-align: center;
            }
        }
    </style>
</head>
<body class="bg-primary text-white">
    <div class="container mt-5">
        <h1 class="text-center">Ticket Details</h1>
        <div class="card bg-light text-dark p-4 mt-4">
            @if(!$ticket)
                <p>No tickets found.</p>
            @else
                <div class="ticket-details">
                    <p><strong>Title/Name:</strong> {{ $ticket->ticketable->title ?? $ticket->ticketable->name ?? $ticket->ticketable->movie->title }}</p>
                    <p><strong>Seats Booked:</strong> {{ $ticket->quantity }}</p>
                    <p><strong>Assigned Seats:</strong></p>
                    <ul>
                        {{-- @foreach($ticket->seats as $seat)
                            <li>Seat #{{ $seat->seat_number }} - Status: {{ ucfirst($seat->status) }}</li>
                        @endforeach --}}
                    </ul>
                    <p><strong>Status:</strong>
                            <span class="text-success">Paid</span>
                    </p>
                    <div class="text-center">
                        {!! QrCode::size(250)->generate($qrCodeData) !!}
                    </div>
                    <p class="text-center mt-3">
                        <a href="javascript:window.print()" class="btn btn-primary">Print</a>
                    </p>
                </div>
            @endif
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Home</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
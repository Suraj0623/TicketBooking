{{-- <!DOCTYPE html>
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
                    <!-- Dynamic Title or Name based on ticketable model -->
                    <p><strong>Title/Name:</strong> {{ $ticket->ticketable->title ?? $ticket->ticketable->name ?? $ticket->ticketable->movie->title }}</p>
                    
                    <!-- Dynamic Seats Booked -->
                    <p><strong>Seats Booked:</strong> {{ $ticket->quantity }}</p>
                    
                    <!-- Dynamic Assigned Seats -->
                    <p><strong>Assigned Seats:</strong></p>
                    <ul>
                        @foreach($ticket->seats as $seat)
                            <li>Seat #{{ $seat->seat_number }} - Status: {{ ucfirst($seat->status) }}</li>
                        @endforeach
                    </ul>

                    <!-- Dynamic Status (Paid or Pending) -->
                    <p><strong>Status:</strong>
                        @if(optional($ticket->booking)->payment && optional($ticket->booking->payment)->status === 'completed')
                            <span class="text-success">Paid</span>
                        @else
                            <span class="text-warning">Pending</span>
                        @endif
                    </p>
                    
                    <!-- Dynamic QR Code using Laravel's QrCode package -->
                    <div class="text-center">
                        {!! QrCode::size(250)->generate($qrCodeData) !!}
                    </div>
                    
                    <!-- Print Button -->
                    <p class="text-center mt-3">
                        <a href="javascript:window.print()" class="btn btn-primary">Print</a>
                    </p>
                </div>
            @endif
        </div>
        
        <!-- Home Button -->
        <div class="text-center mt-3">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .boarding-pass {
            max-width: 700px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .pass-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 2px dashed rgba(255, 255, 255, 0.5);
        }
        .pass-body {
            padding: 20px;
        }
        .qr-code {
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="boarding-pass mx-auto">
            <div class="pass-header">
                <div class="d-flex align-items-center">
                    <i class="fas fa-plane text-white fs-3 me-2"></i>
                    <h5 class="m-0">BOARDING PASS</h5>
                </div>
                <h6 class="m-0">WORLD VECTOR AIRLINES</h6>
            </div>
            <div class="pass-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="fw-bold mb-1">JOHN VOYAGE</p>
                        <small class="text-uppercase">Name of Passenger</small>
                        <hr>
                        <p class="fw-bold mb-1">Madrid / MAD</p>
                        <small class="text-uppercase">From</small>
                        <hr>
                        <p class="fw-bold mb-1">Stockholm / STO</p>
                        <small class="text-uppercase">To</small>
                        <hr>
                        <p class="fw-bold mb-1">ABC1234</p>
                        <small class="text-uppercase">Flight No</small>
                        <hr>
                        <p class="fw-bold mb-1">15 SEP 2019</p>
                        <small class="text-uppercase">Date</small>
                        <hr>
                        <p class="fw-bold mb-1">16:30</p>
                        <small class="text-uppercase">Departure Time</small>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="fw-bold mb-1">M</p>
                        <small class="text-uppercase">Class</small>
                        <hr>
                        <img src="https://storage.googleapis.com/a1aa/image/cdHsmIVI2-ZHn65yInByKHNR_nyITVgmOZTh9Dietc0.jpg" alt="QR Code" class="qr-code my-3">
                        <hr>
                        <p class="fw-bold mb-1">27A</p>
                        <small class="text-uppercase">Seat</small>
                    </div>
                </div>
            </div>
            <div class="text-center py-3 bg-white text-dark fw-bold">
                ENJOY YOUR TRIP!
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .ticket-container {
            max-width: 700px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 2px dashed rgba(255, 255, 255, 0.5);
        }
        .ticket-body {
            padding: 20px;
        }
        .qr-code {
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="ticket-container mx-auto">
            <div class="ticket-header">
                <div class="d-flex align-items-center">
                    <i class="fas fa-ticket-alt text-white fs-3 me-2"></i>
                    <h5 class="m-0">{{ strtoupper($ticketType) }} TICKET</h5>
                </div>
                <h6 class="m-0">UNIVERSAL BOOKING SYSTEM</h6>
            </div>
            <div class="ticket-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="fw-bold mb-1">{{ $ticket->user->name }}</p>
                        <small class="text-uppercase">Name of Passenger/Attendee</small>
                        <hr>
                        
                        @if($ticketType == 'Flight')
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->origin }} / {{ $ticket->ticketable->origin_code }}</p>
                            <small class="text-uppercase">From</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->destination }} / {{ $ticket->ticketable->destination_code }}</p>
                            <small class="text-uppercase">To</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->flight_number }}</p>
                            <small class="text-uppercase">Flight No</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->departure_time }}</p>
                            <small class="text-uppercase">Departure Time</small>
                        @elseif($ticketType == 'Event')
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->title }}</p>
                            <small class="text-uppercase">Event Name</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->venue }}</p>
                            <small class="text-uppercase">Venue</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->event_date }}</p>
                            <small class="text-uppercase">Event Date</small>
                        @elseif($ticketType == 'Movie')
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->title }}</p>
                            <small class="text-uppercase">Movie Title</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->genre }}</p>
                            <small class="text-uppercase">Genre</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->ticketable->director }}</p>
                            <small class="text-uppercase">Director</small>
                            <hr>
                            <p class="fw-bold mb-1">{{ $ticket->booking->created_at->format('d M Y H:i') }}</p>
                            <small class="text-uppercase">Booking Date</small>
                        @endif
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="fw-bold mb-1">{{ $ticket->seats->first()->seat_number ?? 'N/A' }}</p>
                        <small class="text-uppercase">Seat</small>
                        <hr>
                        <img src="{{ asset('path/to/qr-code.png') }}" alt="QR Code" class="qr-code my-3">
                        <hr>
                        <p class="fw-bold mb-1">${{ $ticket->price }}</p>
                        <small class="text-uppercase">Price</small>
                    </div>
                </div>
            </div>
            <div class="text-center py-3 bg-white text-dark fw-bold">
                ENJOY YOUR EXPERIENCE!
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

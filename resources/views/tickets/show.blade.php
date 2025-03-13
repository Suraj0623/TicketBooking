<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
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
    .ticket-header h5,
    .ticket-header h6 {
      margin: 0;
    }
    .ticket-body {
      padding: 20px;
    }
    .ticket-body hr {
      border-top: 1px dashed rgba(255, 255, 255, 0.5);
    }
    .qr-code {
      width: 80px;
      height: 80px;
    }
    /* Print media: Hide navigation buttons */
    @media print {
      #printButton, #home {
        display: none !important;
      }
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
  <div class="container">
    <div class="ticket-container mx-auto">
      <!-- Ticket Header -->
      <div class="ticket-header">
        <div class="d-flex align-items-center">
          <i class="fas fa-ticket-alt fs-3 me-2"></i>
          <h5>{{ strtoupper($ticketType) }} TICKET</h5>
        </div>
        <h6>ALL IN ONE TICKET BOOKING SYSTEM</h6>
      </div>
      <!-- Ticket Body -->
      <div class="ticket-body">
        <div class="row">
          <div class="col-md-8">
            <p class="fw-bold mb-1">{{ $ticket->user->FirstName . ' ' . $ticket->user->LastName }}</p>
            <small class="text-uppercase">Name of Passenger/Attendee</small>
            <p class="fw-bold mb-1">{{ $ticket->user->mobileNumber }}</p>
            <small class="text-uppercase">Phone Number of Passenger/Attendee</small>
            <hr>
            
            @if($ticketType == 'Transport')
              <p class="fw-bold mb-1">{{ $ticket->ticketable->origin }} / {{ $ticket->ticketable->origin_code }}</p>
              <small class="text-uppercase">From</small>
              <hr>
              <p class="fw-bold mb-1">{{ $ticket->ticketable->destination }} / {{ $ticket->ticketable->destination_code }}</p>
              <small class="text-uppercase">To</small>
              <hr>
              <p class="fw-bold mb-1">{{ $ticket->ticketable->flight_number }}</p>
              <small class="text-uppercase">Vehicle No</small>
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
            @elseif($ticketType == 'Tour')
              <p class="fw-bold mb-1">{{ $ticket->ticketable->title }}</p>
              <small class="text-uppercase">Event Name</small>
              <hr>
              <p class="fw-bold mb-1">{{ $ticket->ticketable->venue }}</p>
              <small class="text-uppercase">Venue</small>
              <hr>
              <p class="fw-bold mb-1">{{ $ticket->ticketable->event_date }}</p>
              <small class="text-uppercase">Event Date</small>
            @elseif($ticketType == 'Screening')
              <p class="fw-bold mb-1">{{ $ticket->ticketable->movie->title }}</p>
              <small class="text-uppercase">Movie Title</small>
              <hr>
              <p class="fw-bold mb-1">{{ $ticket->ticketable->movie->genre }}</p>
              <small class="text-uppercase">Genre</small>
              <hr>
              <p class="fw-bold mb-1">{{ $ticket->ticketable->movie->director }}</p>
              <small class="text-uppercase">Director</small>
              <hr>
              <p class="fw-bold mb-1">{{ $ticket->booking->created_at->format('d M Y H:i') }}</p>
              <small class="text-uppercase">Booking Date</small>
            @endif
          </div>
          <div class="col-md-4 text-center">
            @php
            $seat = $ticket->seats->where('status', 'booked')->where('user_id', auth()->id())->first();
          @endphp
          <p class="fw-bold mb-1">
            {{ $seat ? $seat->seat_number : 'N/A' }}
          </p>
          <small class="text-uppercase">Seat</small>
            <p class="mt-2"><strong>Seats Booked:</strong> {{ $ticket->quantity }}</p>
            <hr>
            <div class="text-center">
              {!! QrCode::size(150)->generate($qrCodeData) !!}
            </div>
            <hr>
            <p class="fw-bold mb-1">${{ $ticket->price }}</p>
            <small class="text-uppercase">Total Price</small>
          </div>
        </div>
      </div>
      <!-- Footer Message -->
      <div class="text-center py-3 bg-white text-dark fw-bold">
        ENJOY YOUR EXPERIENCE!
      </div>
      <!-- Print Button -->
      <p class="text-center mt-3">
        <a href="javascript:window.print()" class="btn btn-primary" id="printButton" aria-label="Print Ticket">Print</a>
      </p>
    </div>
    <!-- Back to Home Button -->
    <div class="text-center mt-4">
      <a href="{{ route('welcome') }}" class="btn btn-lg btn-secondary" id="home" aria-label="Go back to Home">Go Back</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

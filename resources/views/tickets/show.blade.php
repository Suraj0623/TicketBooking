
<main>
    <h1>Ticket Details</h1>

    @if(!$ticket)
        <p>No tickets found.</p>
    @else
    <div class="ticket-details">
        <p><strong>Title/Name:</strong> {{ $ticket->ticketable->title ?? $ticket->ticketable->name ?? $ticket->ticketable->movie->title }}</p>
        <p><strong>Seats Booked:</strong> {{ $ticket->quantity }}</p>

        <!-- Display Assigned Booked Seats -->
        <p><strong>Assigned Seats:</strong></p>
<ul>
    @foreach($ticket->seats as $seat)
        <li>Seat #{{ $seat->seat_number }} - Status: {{ ucfirst($seat->status) }}</li>
    @endforeach
</ul>


        <p><strong>Status:</strong>
            @if(optional($ticket->booking)->payment && optional($ticket->booking->payment)->status === 'completed')
                <span class="text-success">Paid</span>
            @else
                <span class="text-warning">Pending</span>
            @endif
        </p>

        <!-- Display the QR Code -->
        <div class="ticket-qr">
            {!! QrCode::size(250)->generate($qrCodeData) !!}
        </div>

        <p>
            <a href="javascript:window.print()" class="btn btn-secondary">
                Print
            </a>
        </p>
    </div>
    @endif

    <div>
        <p>
            <a href="{{ route('welcome') }}" class="btn btn-secondary">
                Home
            </a>
        </p>
    </div>
</main>
<!-- Print-specific Styles -->
<style>
    /* Basic Styles for the PDF-like look */
    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    main {
        width: 100%;
        padding: 20px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .ticket-details {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }

    .ticket-details p {
        margin: 8px 0;
    }

    .text-success {
        color: green;
    }

    .text-warning {
        color: orange;
    }

    /* Button Style for print */
    .btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    /* Media query for printing */
    @media print {
        body {
            background-color: white;
        }

        header, footer {
            display: none; /* Hide header and footer on print */
        }

        .ticket-details {
            border: none;
            padding: 10px;
            background-color: white;
            box-shadow: none;
        }

        .btn {
            display: none; /* Hide the 'pay' button in the print version */
        }

        h1 {
            font-size: 28px;
            text-align: center;
        }

        .ticket-details p {
            font-size: 16px;
            line-height: 1.8;
        }
    }
</style> 

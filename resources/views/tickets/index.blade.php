



<div class="container">
    <h1>Your Tickets</h1>

    @if ($tickets->isEmpty())
        <p>No tickets available. Complete your booking payment to generate tickets.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Type</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Booked Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->user_id }}</td>
                        <td>{{ $ticket->ticketable_type?? 'N/A' }}</td>
                        <td>${{ number_format($ticket->price, 2) }}</td>
                        <td>{{ $ticket->quantity }}</td>
                        <td>{{ $ticket->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

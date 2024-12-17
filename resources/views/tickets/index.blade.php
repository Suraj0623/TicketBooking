<x-header />
<main>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Tickets</h1>

        @if ($allTickets->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No tickets available. Make a booking & pay to generate tickets.
            </div>
        @else
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2">UserName</th>
                        <th>Type</th>
                        <th>Total Price</th>
                        <th>Quantity</th>
                        <th>Booked Date</th>
                        <th>Validation Time</th>
                        <th>Expiration Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allTickets as $ticket)
                        <tr>
                            <td>{{ $ticket->user->FirstName }}</td>
                            <td>{{ $ticket->user->LastName }}</td>
                            <td>{{ $ticket->ticketable_type ?? 'N/A' }}</td>
                            <td>${{ number_format($ticket->price, 2) }}</td>
                            <td>{{ $ticket->quantity }}</td>
                            <td>{{ $ticket->created_at->format('d M Y') }}</td>
                            <td>
                                @php
                                    $createdAt = $ticket->created_at;
                                    $now = \Carbon\Carbon::now();
                                    $difference = $createdAt->diffForHumans($now);
                                @endphp
                                <span class="text-muted">{{ $difference }}</span>
                            </td>
                            <td>
                                @php
                                    // Assuming tickets have an expiration date
                                    $expirationDate = \Carbon\Carbon::parse($ticket->expiration_date);
                                    $daysRemaining = $expirationDate->diffInDays($now);
                                    $isExpired = $expirationDate->isPast();
                                @endphp
                                @if ($isExpired)
                                    <span class="text-danger">Expired</span>
                                @else
                                    <span class="text-success">{{ $daysRemaining }} days remaining</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}"
                                    class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>
<x-footer />

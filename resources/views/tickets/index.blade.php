<x-header />
<main class="mt-5 pt-5">

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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Bookable Type</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Booked Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allTickets as $ticket)
                    <tr>
                        <td>{{ $ticket->user->FirstName ?? 'N/A' }}</td>
                        <td>{{ $ticket->user->LastName ?? 'N/A' }}</td>
                        <td>{{ class_basename($ticket->booking?->bookable_type) ?? 'N/A' }}</td>
                        <td>{{ $ticket->quantity }}</td>
                        <td>${{ number_format($ticket->price, 2) }}</td>
                        <td>{{ ucfirst($ticket->booking?->payment_status ?? 'Paid') }}</td>
                        <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</main>
<x-footer />
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    
    {{-- {{$bookings->links()}} --}}
    @extends('layouts.admin') {{-- Assuming you have an admin layout --}}

@section('title', 'Manage Bookings')

@section('content')
<div class="container">
    <h1 class="mb-4">Bookings Management</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Bookable Type</th>
                <th>Bookable Item</th>
                <th>Seats Booked</th>
                <th>Total Price</th>
                <th>Payment Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>{{ class_basename($booking->bookable_type) }}</td>
                    <td>{{ $booking->bookable->name ?? 'N/A' }}</td>
                    <td>{{ $booking->seats_booked }}</td>
                    <td>${{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : 'warning' }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </td>
                    <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this booking?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No bookings available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{-- {{ $bookings->links() }} Laravel pagination links --}}
    </div>
</div>
@endsection

</body>
</html>
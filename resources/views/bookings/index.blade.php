@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center text-primary">Bookings Management</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive bg-white p-3 rounded border border-black">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                <tr  class="text-center">
                    <th>S.N</th>
                    <th colspan="2">User</th>
                    <th>Mobile Number</th>
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
                @forelse($bookings as $index => $booking)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $booking->user->FirstName ?? 'N/A' }}</td>
                        <td>{{ $booking->user->LastName ?? 'N/A' }}</td>
                        <td>{{ $booking->user->mobileNumber ?? 'N/A' }}</td>
                        <td>{{ class_basename($booking->bookable_type) }}</td>
                        <td>{{ $booking->bookable->title ?? $booking->bookable->name ?? $booking->bookable->movie->title ?? 'N/A' }}</td>
                        <td>{{ $booking->seats_booked }}
                            <a href="{{ route('seats.view', $booking->id) }}" class="btn btn-sm btn-info">View Seats</a>
                        </td>
                        <td>${{ number_format($booking->total_price, 2) }}</td>
                        <td>
                            <!-- Payment Status Badge -->
                            <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : ($booking->payment_status === 'failed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </td>
                        <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <!-- Edit and Delete buttons always visible -->
                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">
                                    Delete
                                </button>
                            </form>

                            <!-- Only show Accept and Reject buttons for pending payments -->
                            @if ($booking->payment_status === 'pending')
                                <!-- Accept button form -->
                                <form action="{{ route('booking.accept', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                </form>

                                <!-- Reject button form -->
                                <form action="{{ route('booking.reject', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @else
                                <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : ($booking->payment_status === 'failed' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No bookings available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <div class="mt-3">
            {{ $bookings->links() }} {{-- Laravel pagination links --}}
        </div>
    </div>
    <x-footer/>
@endsection

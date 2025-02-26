@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Transport Search Results</h2>

    <!-- Search Filters Display -->
    <div class="alert alert-info mb-4">
        <h5><strong>Search Criteria:</strong></h5>
        <p><strong>Origin:</strong> {{ request('origin') }}</p>
        <p><strong>Destination:</strong> {{ request('destination') }}</p>
        <p><strong>Departure Date:</strong> {{ request('departure_date') }}</p>
        <p><strong>Transport Type:</strong> {{ request('transport_type') }}</p>
    </div>

    <!-- Display results -->
    @if($transports->isEmpty())
        <div class="alert alert-warning text-center">
            <p>No available transports found for the selected criteria.</p>
        </div>
    @else
        <div class="row">
            @foreach($transports as $transport)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">{{ $transport->route->origin }} to {{ $transport->route->destination }}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Departure Date:</strong> 
                                @php echo \Carbon\Carbon::parse($transport->departure_date)->format('Y-m-d'); @endphp
                            </p>
                            <p><strong>Transport Name:</strong> {{ $transport->name }}</p>
                            <p><strong>Route:</strong> {{ $transport->route->origin }} <strong>TO</strong> {{ $transport->route->destination }}</p>
                            <p><strong>Transport Type:</strong> {{ ucfirst($transport->type) }}</p>
                            <a href="{{ route('booking.create', ['bookable_id' => $transport->id, 'bookable_type' => get_class($transport)]) }}" class="btn btn-success w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

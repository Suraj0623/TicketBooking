<form action="{{ route('bookings.create') }}" method="GET" class="d-inline">
    <input type="hidden" name="bookable_type" value="{{ $bookableType }}">
    <input type="hidden" name="bookable_id" value="{{ $bookableId }}">
    <button type="submit" class="btn btn-primary">Book Now</button>
</form>

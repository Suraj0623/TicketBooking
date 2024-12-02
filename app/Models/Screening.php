<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $guarded=[];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function seats()
    {
        return $this->morphOne(Seat::class, 'seatable');
    }
    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    // Relation to tickets
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }
}

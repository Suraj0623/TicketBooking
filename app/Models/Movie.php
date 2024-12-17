<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded=[];
    public function bookings()
{
    return $this->morphMany(Booking::class, 'bookable');
}

public function seats()
{
    return $this->morphMany(Seat::class, 'seatable');
}

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}

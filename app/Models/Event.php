<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded=[];
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function seats()
    {
        return $this->morphOne(Seat::class,'seatable');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

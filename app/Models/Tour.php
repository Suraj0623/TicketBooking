<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours'; 
    protected $guarded=[];
    public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function seats()
{
    return $this->morphOne(Seat::class, 'seatable');
}


}

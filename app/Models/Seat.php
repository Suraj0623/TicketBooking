<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public $timestamps=false;
    protected $guarded=[];
    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
    public function seatable()
    {
        return $this->morphTo();
    }
}

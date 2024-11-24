<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;

class Booking extends Model
{
    // public $timestamps=false;
    protected $guarded=[];
   
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookable()
    {
        return $this->morphTo();
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded=[];
    public function ticketable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
{
    return $this->belongsTo(Booking::class, 'ticketable_id', 'id');
}
}

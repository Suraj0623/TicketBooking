<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'bookable_type',
        'bookable_id',
        'seats_booked',
        'total_price',
        'payment_status',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array<string>
     */
    protected $with = ['bookable'];

    
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
        return $this->hasOne(Payment::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticketable_id')->where('ticketable_type', self::class);
    }
}
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
}
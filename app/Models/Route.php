<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $timestamps=false;
    protected $guarded=[];
    
    
    public function transports()
{
    return $this->hasMany(Transport::class, 'route_id');
}

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}

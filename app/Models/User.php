<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    // public $timestamps=false;
    // protected $guarded=[];
    public function bookings()
{
    return $this->morphMany(Booking::class, 'bookable');
}

    
   
    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_user');
}


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'FirstName', 
        'LastName',
         'email', 
         'mobileNumber',
          'password', 
          
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            
            'password' => 'hashed',
        ];
    }
}
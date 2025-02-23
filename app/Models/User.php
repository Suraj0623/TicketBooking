<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    // public $timestamps=false;
    // protected $guarded=[];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    protected static function boot()
    {
        parent::boot();

        // Event to handle profile creation after a user is created
        static::created(function ($user) {
            Profile::create([
                'user_id' => $user->id,
                'FirstName' => $user->FirstName,
                'LastName' => $user->LastName,
                'email' => $user->email,
                'mobileNumber' => $user->mobileNumber,
                'password' => $user->password,
            ]);
        });

        // Event to handle profile update after a user is updated
        static::updated(function ($user) {
            $profile = Profile::where('user_id', $user->id)->first();
            if ($profile) {
                $profile->update([
                    'FirstName' => $user->FirstName,
                    'LastName' => $user->LastName,
                    'email' => $user->email,
                    'mobileNumber' => $user->mobileNumber,
                    'password' => $user->password,
                ]);
            }
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'role_id', 'user_id');
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
    protected function preferences(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }
}

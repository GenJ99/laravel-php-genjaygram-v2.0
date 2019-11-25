<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // BOOT FUNCTION- CREATE USER PROFILE
    protected static function boot() {
        parent::boot(); 
        
        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
            ]);
        });
    }

    // Has many relationship for users that view in descending order.
    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    // Adds the relationship of User to Profile
    public function profile() {
        return $this->hasOne(Profile::class);
    }
}

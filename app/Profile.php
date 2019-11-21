<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    // Adds the relationship of Profile to User
    public function user() {
        return $this->belongsTo(User::class);
    }
}

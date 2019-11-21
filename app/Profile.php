<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Adds the relationship of Profile to User
    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    // Adds either the user created profile image or a stock image for the empty
    // field.
    public function profileImage() {
        $imagePath = ($this->image) ? $this->image : 'profile/aFOmOSdyUKrhChyZ9SumEgkTdeo1jgciYq5f3XMp.jpeg';

        return '/storage/' . $imagePath;
    }

    // Adds the relationship of Profile to User
    public function user() {
        return $this->belongsTo(User::class);
    }
}

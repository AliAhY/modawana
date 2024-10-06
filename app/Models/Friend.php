<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = ['profile_id', 'friend_profile_id'];

    // علاقة بين الملف الشخصي وصديقه
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function friendProfile()
    {
        return $this->belongsTo(Profile::class, 'friend_profile_id');
    }

}

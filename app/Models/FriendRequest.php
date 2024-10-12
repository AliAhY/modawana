<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class FriendRequest extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = ['sender_profile_id', 'recipient_profile_id'];

    public function sender()
    {
        return $this->belongsTo(Profile::class, 'sender_profile_id');
    }


    public function recipient()
    {
        return $this->belongsTo(Profile::class, 'recipient_profile_id');
    }


    public function senderProfile()
    {
        return $this->belongsTo(Profile::class, 'sender_profile_id');
    }
}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friend extends Model
{
    use HasFactory;
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

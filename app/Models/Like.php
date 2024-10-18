<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    
    protected $fillable = ['profile_id', 'post_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // العلاقة مع Post  
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

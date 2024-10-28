<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // إضافة هذا السطر
use App\Models\FriendRequest;
use App\Models\Friend;

class Profile extends Model
{
    use HasFactory, Notifiable; // إضافة Notifiable هنا
    public $guarded = [];

    // العلاقة مع نموذج User  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // طلبات الصجاقة
    public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_profile_id');
    }
    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'recipient_profile_id');
    }
    //=====================

    // الاصدقاء
    public function friends()
    {
        return $this->belongsToMany(Profile::class, 'friends', 'profile_id', 'friend_profile_id');
    }
    public function friendOf()
    {
        return $this->belongsToMany(Profile::class, 'friends', 'profile_id', 'friend_profile_id');
    }
    //=====================

    // البوستات
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    //=====================


    // العلاقة مع Likes  
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    //=====================

    // اعجابات البروفايل بالعليقات
    public function commentLikes()  
    {  
        return $this->hasMany(CommentLike::class);  
    } 
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // الحصول على معرف المستخدم الحالي  
        $currentProfile = auth()->user()->profile;

        // الحصول على id الأصدقاء  
        $friendIds = $currentProfile->friends()->pluck('friend_profile_id')->toArray();

        // إضافة معرف المستخدم الحالي إلى القائمة  
        $friendIds[] = $currentProfile->id;

        // جلب البوستات الخاصة بي وبوستات الأصدقاء  
        $posts = Post::with('comments.profile')
            ->whereIn('profile_id', $friendIds)
            ->latest() // ترتيب البوستات من الأحدث إلى الأقدم  
            // ->take(3) // أخذ آخر 3 بوستات فقط  
            ->get();
        // return $posts;
        //السبب في استخدام whereIn بدلاً من where هو أن whereIn يسمح بالتحقق من مجموعة من القيم، وليس قيمة واحدة فقط.
        return view('site.layouts.index', compact('posts'));
    }

    public function allProfile(){
        $profiles = Profile::all();
        // return $all_profiles;
        return view('site.profile.allprofile', compact('profiles'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin\Books;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // الحصول على معرف المستخدم الحالي
        $current_user_id = Auth::id();
        // جلب جميع البروفايلات ماعدا بروفايل المستخدم الحالي
        $profiles = Profile::where('user_id', '!=', $current_user_id)->get();
        // return $profiles;
        return view('site.layouts.index', compact('profiles'));
    }
}

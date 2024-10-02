<?php

namespace App\Http\Controllers;

use App\Models\Admin\Books;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $profiles= Profile::all();
        return view('site.layouts.index', compact('profiles'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user_profile = Profile::findOrFail($id);
        $user_name = User::findOrFail($id);
        // return $user_profile;
        return view('site.profile.index', compact('user_profile', 'user_name'));
    }

    public function edit_profile_form($id)
    {
        $user_profile = Profile::findOrFail($id);
        return view('site.profile.edit_profile', compact('user_profile'));
    }


    public function update_profile(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'location' => 'nullable|string',
            'skills' => 'nullable|string',
            'professional_title' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'interests' => 'nullable|string',
            'school_name' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'image' => 'nullable|max:10000',  
            'cover_image' => 'nullable|max:10000',
        ]);



        try {
        $profile = Profile::findOrFail($id);
        $profile->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'location' => $request->location,
            'skills' => $request->skills,
            'professional_title' => $request->professional_title,
            'date_of_birth' => $request->date_of_birth,
            'school_name' => $request->school_name,
            'phone_number' => $request->phone_number,
            'interests' => $request->interests,
            'avatar' => $request->image,
            'cover_image' => $request->cover_image,
            'email' => $request->email,
        ]);

        return redirect()->route('user.edit_profile_form', $profile->id)->with('success', 'The profile has been updated successfully');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Something happened']);
        }
    }

    public function upload_profile_photo(Request $request, $id)
    {
        $user = Profile::where('id', $id)->first(); // استخدم first() للحصول على نتيجة واحدة  

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'Image not provided'], 400);
        }

        $user_name = $user->name; // احصل على اسم المستخدم  

        // upload image  

        $userDirectory = "public/media/users/$user_name/images/profile";

        // تحقق من وجود المجلد، إذا لم يكن موجودًا قم بإنشائه  
        if (!Storage::exists($userDirectory)) {
            Storage::makeDirectory($userDirectory);
        }

        // احصل على الملف  
        $file = $request->file('image');

        // قم بتحديد اسم الملف  
        $filename = $filename = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

        // قم بتخزين الصورة في المجلد الخاص بالمستخدم  
        $file->storeAs($userDirectory, $filename);

        return response()->json(['filename' => $filename], 200);
    }


    public function upload_profile_cover(Request $request, $id)
    {
        $user = Profile::where('id', $id)->first(); // استخدم first() للحصول على نتيجة واحدة  

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!$request->hasFile('cover_image')) {
            return response()->json(['error' => 'Image not provided'], 400);
        }

        $user_name = $user->name; // احصل على اسم المستخدم  

        // upload image  
        // $userDirectory = "public/media/users/cover/$user_name";
        $userDirectory = "public/media/users/$user_name/images/cover";
        // تحقق من وجود المجلد، إذا لم يكن موجودًا قم بإنشائه  
        if (!Storage::exists($userDirectory)) {
            Storage::makeDirectory($userDirectory);
        }

        // احصل على الملف  
        $file = $request->file('cover_image');

        // قم بتحديد اسم الملف  
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // قم بتخزين الصورة في المجلد الخاص بالمستخدم  
        $file->storeAs($userDirectory, $filename);

        return response()->json(['filename' => $filename], 200);
    }
}

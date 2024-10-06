<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\Profile;
use App\Models\User;
use Exception;
use App\Notifications\FriendRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user_name = User::where('id', $id)->with('profile')->first();
        return view('site.profile.index', compact('user_name'));
    }

    public function edit_profile_form($id)
    {
        $user_profile = Profile::findOrFail($id);
        return view('site.profile.edit_profile', compact('user_profile'));
    }


    public function update_profile(Request $request, string $id)
    {

        try {
            $user = Profile::findOrFail($id);
            // المصوفة للتحديث
            $updateData = $request->only([
                'name',
                'bio',
                'location',
                'skills',
                'professional_title',
                'date_of_birth',
                'school_name',
                'universe_name',
                'phone_number',
                'interests',
                'email'
            ]);

            // إعداد مسار التخزين
            $user_name = $user->name;
            $userDirectory = "public/media/users/$user_name/images/profile";

            // تحقق مما إذا كان هناك صورة جديدة للملف الشخصي
            if ($request->hasFile('image')) {
                $updateData['avatar'] = $request->file('image')->store($userDirectory, 'local');
            } else {
                $updateData['avatar'] = $user->avatar; // استخدام الصورة القديمة
            }

            // تحقق مما إذا كان هناك صورة جديدة لصورة الغلاف
            if ($request->hasFile('cover_image')) {
                $updateData['cover_image'] = $request->file('cover_image')->store($userDirectory, 'local');
            } else {
                $updateData['cover_image'] = $user->cover_image; // استخدام صورة الغلاف القديمة
            }

            // تحديث الملف الشخصي
            $user->update($updateData);

            $userName = User::findOrFail($user->user_id);
            if (isset($updateData['name'])) {
                $userName->name = $updateData['name'];
                $userName->save(); // حفظ التغييرات
            }

            return redirect()->route('user.edit_profile_form', $user->id)
                ->with('success', 'The profile has been updated successfully');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Something happened: ' . $e->getMessage()]);
        }
    }

    public function show_other($name, $id)
    {
        $other_profile = Profile::where('id', $id)->where('name', $name)->first();

        // استرجاع المستخدم الحالي
        $currentProfile = auth()->user()->profile; // تأكد من أن لديك علاقة صحيحة للحصول على الملف الشخصي للمستخدم الحالي
        // return $currentProfile;
        // تحقق مما إذا كانت الصداقة موجودة
        $isFriend = DB::table('friends')
            ->where('profile_id', $currentProfile->id)
            ->where('friend_profile_id', $other_profile->id)
            ->exists();

        return view('site.profile.other_profile', compact('other_profile', 'currentProfile', 'isFriend'));
    }

    public function upload_profile_photo(Request $request, $id)
    {
        $user = Profile::where('id', $id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'Image not provided'], 400);
        }

        // $user_name = $user->id;

        // upload image
        $userDirectory = "public/media/users/User_ID_$user->user_id/images/profile";

        if (!Storage::exists($userDirectory)) {
            Storage::makeDirectory($userDirectory);
        }

        $file = $request->file('image');
        $filename = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($userDirectory, $filename);

        // تخزين اسم الملف في الحقل avatar
        $user->avatar = json_encode(['filename' => $filename]);
        $user->save();

        return response()->json(['filename' => $filename], 200);
    }

    public function upload_profile_cover(Request $request, $id)
    {
        $user = Profile::where('id', $id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!$request->hasFile('cover_image')) {
            return response()->json(['error' => 'Image not provided'], 400);
        }

        $user_name = $user->name;
        // upload image
        $userDirectory = "public/media/users/User_ID_$user->user_id/images/cover";

        if (!Storage::exists($userDirectory)) {
            Storage::makeDirectory($userDirectory);
        }

        $file = $request->file('cover_image');
        $filename = $user->id . '_cover_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($userDirectory, $filename);

        // تخزين اسم الملف في الحقل cover_image
        $user->cover_image = json_encode(['filename' => $filename]); // تأكد من وجود حقل cover_image في قاعدة البيانات
        $user->save();

        return response()->json(['filename' => $filename], 200);
    }


    public function sendFriendRequest(Request $request, $recipientId)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $senderProfile = auth()->user()->profile;

        if (!$senderProfile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        $recipientProfile = Profile::findOrFail($recipientId);

        // تحقق مما إذا كان الطلب موجودًا بالفعل
        if (FriendRequest::where('sender_profile_id', $senderProfile->id)->where('recipient_profile_id', $recipientProfile->id)->exists()) {
            return response()->json(['error' => 'Friend request already exists.'], 400);
        }

        // تخزين طلب الصداقة
        FriendRequest::create([
            'sender_profile_id' => $senderProfile->id,
            'recipient_profile_id' => $recipientProfile->id,
        ]);

        // إرسال الإشعار
        $recipientProfile->notify(new FriendRequestNotification($senderProfile));

        return back()->with('success', 'Friend request sent successfully.');
        //  response()->json(['success' => 'Friend request sent successfully.'], 200);
    }
    public function acceptFriendRequest($requestId)
    {
        $request = FriendRequest::findOrFail($requestId);

        // إضافة الصديق
        Friend::create([
            'profile_id' => $request->recipient_profile_id,
            'friend_profile_id' => $request->sender_profile_id,
        ]);

        // حذف طلب الصداقة
        $request->delete();

        return back()->with('success', 'تم قبول طلب الصداقة.');
    }

    public function rejectFriendRequest($requestId)
    {
        // العثور على طلب الصداقة باستخدام المعرف
        $friendRequest = FriendRequest::find($requestId);

        // التحقق مما إذا كان طلب الصداقة موجودًا
        if (!$friendRequest) {
            return response()->json(['message' => 'طلب الصداقة غير موجود.'], 404);
        }

        // التحقق مما إذا كان المستلم هو المستخدم الحالي قبل رفض الطلب
        if ($friendRequest->recipient_profile_id != auth()->user()->id) {
            return response()->json(['message' => 'ليس لديك إذن لرفض هذا الطلب.'], 403);
        }

        // حذف طلب الصداقة (أو يمكنك تغيير الحالة إذا كنت تحتفظ بها)
        $friendRequest->delete();

        // إرجاع استجابة ناجحة
        return response()->json(['message' => 'تم رفض طلب الصداقة بنجاح.']);
    }

    public function showFriendRequests($id)
    {
        $friendRequests = FriendRequest::where('recipient_profile_id', $id)->get();
        // return $friendRequests;
        return view('site.profile.Friendes.addRequest', compact('friendRequests'));
    }

    public function showFriends($id)
    {
        $friendRequests = Friend::where('profile_id', $id)->get();
        // return $friendRequests;
        return view('site.profile.Friendes.friendes', compact('friendRequests'));
    }


}

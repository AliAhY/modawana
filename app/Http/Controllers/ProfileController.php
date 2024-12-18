<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\Post;
use App\Notifications\FriendRequestNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    // public function profile($id, $post_id = null)
    // {
    //     $user_name = User::where('id', $id)->with('profile')->first();
    //     $posts = Post::with('comments.profile')->where('profile_id', $id)->get();
    //     // return $posts;
    //     $num_posts = Post::with('comments.profile')->where('profile_id', $id)->count();
    //     $img_posts = Post::with('comments.profile')->where('profile_id', $id)->where('image', '!=', null)->get();
    //     $num_of_frind = Friend::where('profile_id', $id)->count();
    //     // return $img_posts;
    //     $activeTab = 'Profile';
    //     $post = Post::with('likes.profile')->where('id', $post_id)->first();
    //     // return $post;
    //     return view('site.profile.index', compact('user_name', 'activeTab', 'posts', 'num_posts', 'img_posts', 'num_of_frind', 'post'));
    // }

    public function profile($id, $post_id = null)
    {
        $user_name = User::where('id', $id)->with('profile')->first();
        $posts = Post::with('comments.profile')->where('profile_id', $id)->get();
        $num_posts = Post::with('comments.profile')->where('profile_id', $id)->count();
        $img_posts = Post::with('comments.profile')->where('profile_id', $id)->where('image', '!=', null)->get();
        $num_of_frind = Friend::where('profile_id', $id)->count();
        $activeTab = 'Profile';

        return view('site.profile.index', compact('user_name', 'activeTab', 'posts', 'num_posts', 'img_posts', 'num_of_frind'));
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
            // $userDirectory = "public/media/users/User_ID_$user->user_id/images/profile";
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


    public function show_other($name, $id)
    {
        $other_profile = Profile::where('id', $id)->where('name', $name)->first();
        // استرجاع المستخدم الحالي
        $currentProfile = auth()->user()->profile;
        // return $currentProfile;
        // تحقق مما إذا كانت الصداقة موجودة
        $isFriend = DB::table('friends')
            ->where('profile_id', $currentProfile->id)
            ->where('friend_profile_id', $other_profile->id)
            ->exists();
        $activeTab = 'Profile';
        $posts = Post::with('comments.profile')->where('profile_id', $id)->get();
        $num_posts = Post::with('comments.profile')->where('profile_id', $id)->count();
        $img_posts = Post::with('comments.profile')->where('profile_id', $id)->where('image', '!=', null)->get();
        return view('site.profile.other_profile', compact('other_profile', 'currentProfile', 'isFriend', 'activeTab', 'posts', 'num_posts', 'img_posts'));
    }

    public function friends_of_other($name, $id)
    {
        // return $name;
        $other_profile = Profile::where('id', $id)->where('name', $name)->first();
        $currentProfile = auth()->user()->profile;
        $activeTab = 'Friends';
        $friend_of_other = Friend::where('profile_id', $id)->get();
        $num_posts = Post::with('comments.profile')->where('profile_id', $id)->count();
        // return $friend_of_other;
        return view('site.profile.frindes_of_other', compact('other_profile', 'currentProfile', 'activeTab', 'friend_of_other', 'num_posts'));
    }


    public function acceptFriendRequest($requestId)
    {
        $request = FriendRequest::findOrFail($requestId);
        // إضافة الصديق
        Friend::create([
            'profile_id' => $request->recipient_profile_id,
            'friend_profile_id' => $request->sender_profile_id,
        ]);
        Friend::create([
            'profile_id' => $request->sender_profile_id,
            'friend_profile_id' => $request->recipient_profile_id,
        ]);
        // حذف طلب الصداقة
        $request->delete();
        return back()->with('success', 'تم قبول طلب الصداقة.');
    }


    public function rejectFriendRequest($requestId)
    {
        // return $requestId;
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
        return redirect()->back()->with('success', 'تم رفض الصداقة بنجاح.');
    }


    public function showFriendRequests($id)
    {
        $friendRequests = FriendRequest::where('recipient_profile_id', $id)->get();
        $num_of_frind_req = FriendRequest::where('recipient_profile_id', $id)->count();
        $activeTab = 'Friends Request';
        $num_posts = Post::with('comments.profile')->where('profile_id', $id)->count();
        return view('site.profile.Friendes.addRequest', compact('friendRequests', 'num_of_frind_req', 'activeTab', 'num_posts'));
    }
    public function showFriends($id)
    {
        $friendRequests = Friend::where('profile_id', $id)->get();
        $num_of_frind = Friend::where('profile_id', $id)->count();
        $activeTab = 'Friends';
        $num_posts = Post::with('comments.profile')->where('profile_id', $id)->count();
        return view('site.profile.Friendes.friendes', compact('friendRequests', 'num_of_frind', 'activeTab', 'num_posts'));
    }

    public function AllAddsFriends($id)
    {
        $all_friends_adds = FriendRequest::where('sender_profile_id', $id)->get();
        $num_of_frinds_add = FriendRequest::where('sender_profile_id', $id)->count();
        $activeTab = 'Add Friends';
        $num_posts = Post::with('comments.profile')->where('profile_id', $id)->count();
        return view('site.profile.Friendes.addSend', compact('all_friends_adds', 'num_of_frinds_add', 'activeTab', 'num_posts'));
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
        if (FriendRequest::where('sender_profile_id', $senderProfile->id)
            ->where('recipient_profile_id', $recipientProfile->id)
            ->exists()
        ) {
            return response()->json(['error' => 'Friend request already exists.'], 400);
        }

        // تخزين طلب الصداقة  
        FriendRequest::create([
            'sender_profile_id' => $senderProfile->id,
            'recipient_profile_id' => $recipientProfile->id,
        ]);

        // إرسال الإشعار  
        $recipientProfile->notify(new FriendRequestNotification($senderProfile));

        return back()->with('success', 'Friend request sent successfully.')->with('friend_id', $recipientProfile->id);
    }

    public function cancelFriendRequest(Request $request, $recipientId)
    {
        $senderProfile = auth()->user()->profile;
        if (!$senderProfile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        $recipientProfile = Profile::findOrFail($recipientId);

        // البحث عن طلب الصداقة وإزالته  
        $friendRequest = FriendRequest::where('sender_profile_id', $senderProfile->id)
            ->where('recipient_profile_id', $recipientProfile->id)
            ->first();

        if ($friendRequest) {
            $friendRequest->delete();
            return back()->with('success', 'Friend request canceled successfully.')->with('friend_id', $recipientProfile->id);
        }

        return back()->with('error', 'No friend request found to cancel.');
    }

    public function removeFriend($id)
    {
        $currentProfile = auth()->user()->profile;
        $otherProfile = Profile::findOrFail($id);

        // إلغاء الصداقة من كلا الجانبين  
        $currentProfile->friends()->detach($otherProfile->id);
        $otherProfile->friends()->detach($currentProfile->id); // إزالة الصداقة من الجانب الآخر  

        return redirect()->back()->with('success', 'تم إلغاء الصداقة بنجاح.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Notifications\FriendRequestNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendshipController extends Controller
{
    public function sendFriendRequest($recipientId)
    {
        $recipient = User::find($recipientId);
        $sender = Auth::user();

        // تحقق مما إذا كان هناك طلب صداقة موجود بالفعل
        if (FriendRequest::where('sender_id', $sender->id)->where('recipient_id', $recipient->id)->exists()) {
            return back()->with('error', 'لقد أرسلت بالفعل طلب صداقة لهذا المستخدم.');
        }

        // تخزين طلب الصداقة
        $friendRequest = FriendRequest::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);

        // إرسال الإشعار
        $recipient->notify(new FriendRequestNotification($sender));

        return back()->with('success', 'تم إرسال طلب الصداقة بنجاح.');
    }

    public function acceptFriendRequest($requestId)
    {
        $friendRequest = FriendRequest::find($requestId);

        if ($friendRequest) {
            // هنا يمكنك إضافة الصديق إلى جدول الأصدقاء
            DB::table('friends')->insert([
                'user_id' => $friendRequest->recipient_id,
                'friend_id' => $friendRequest->sender_id,
            ]);

            // حذف طلب الصداقة بعد القبول
            $friendRequest->delete();

            return back()->with('success', 'تم قبول طلب الصداقة.');
        }

        return back()->with('error', 'طلب الصداقة غير موجود.');
    }
}

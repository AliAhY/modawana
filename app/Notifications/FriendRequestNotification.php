<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $senderProfile;

    public function __construct($senderProfile)
    {
        $this->senderProfile = $senderProfile;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // يمكنك إضافة قنوات أخرى إذا لزم الأمر
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender_profile_id' => $this->senderProfile->id,
            'sender_name' => $this->senderProfile->name,
            'message' => 'لديك طلب صداقة جديد من ' . $this->senderProfile->name,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('طلب صداقة جديد')
            ->line('لديك طلب صداقة جديد من ' . $this->senderProfile->name)
            ->action('عرض الطلبات', url('/friend-requests'))
            ->line('شكراً لك!');
    }
}

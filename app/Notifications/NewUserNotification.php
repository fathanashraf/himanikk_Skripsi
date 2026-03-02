<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\User;

class NewUserNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database']; // Simpan ke database
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'title' => 'User baru bergabung',
            'message' => $this->user->name . ' telah mendaftar sebagai anggota HIMANIKKA',
            'action_url' => route('admin.users.show', $this->user),
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_avatar' => $this->user->avatar,
            'user_email' => $this->user->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => 'User baru bergabung',
            'message' => $this->user->name . ' telah mendaftar sebagai anggota HIMANIKKA',
            'action_url' => route('admin.users.show', $this->user),
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_avatar' => $this->user->avatar,
            'user_email' => $this->user->email,
        ];
    }
}

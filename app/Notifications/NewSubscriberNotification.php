<?php

namespace App\Notifications;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Messages\MailMessage;


class NewSubscriberNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $subscriber;

    /**
     * Create a new notification instance.
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Subscriber Baru di Winnicode')
            ->greeting('Halo Admin,')
            ->line('Ada pelanggan baru yang mendaftar ke newsletter.')
            ->line('Email: ' . $this->subscriber->email)
            ->line('Terima kasih.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Article;
use Illuminate\Support\Str;

class NewArticleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $article;
    public $id;

    /**
     * Create a new notification instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->id = (string) Str::uuid();
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
            ->subject('Artikel Baru dari ' . $this->article->author->name)
            ->greeting('Hai!')
            ->line('Ada artikel baru yang baru saja dipublikasikan:')
            ->line('📰 Judul: ' . $this->article->title)
            ->action('Baca Sekarang', url('/articles/' . $this->article->id))
            ->line('Terima kasih telah mengikuti Winnicode.');
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

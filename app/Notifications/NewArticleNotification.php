<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Article;

class NewArticleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Article $article;

    /**
     * Create a new notification instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
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
            ->action('Baca Sekarang', url('/articles/' . $this->article->slug))
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

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrainingKickedNotification extends Notification
{
    use Queueable;

    protected $training;

    /**
     * Create a new notification instance.
     */
    public function __construct($training)
    {
        $this->training = $training;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Dikeluarkan dari Training')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Anda telah dikeluarkan dari training "' . $this->training->name . '"')
            ->line('Jika ada pertanyaan, silakan hubungi admin.')
            ->action('Lihat Training Lainnya', route('training.index'))
            ->salutation('Salam, Tim Training');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Dikeluarkan dari Training',
            'message' => 'Anda telah dikeluarkan dari training "' . $this->training->name . '"',
            'training_id' => $this->training->id,
            'training_name' => $this->training->name,
            'action_url' => route('training.index'),
            'type' => 'training_kicked',
        ];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}

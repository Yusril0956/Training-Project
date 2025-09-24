<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrainingRejectedNotification extends Notification
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
            ->subject('Pendaftaran Training Ditolak')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Maaf, pendaftaran Anda untuk training "' . $this->training->name . '" telah ditolak.')
            ->line('Jangan berkecil hati, masih ada kesempatan lain untuk mengikuti training lainnya.')
            ->action('Lihat Training Lainnya', route('training.index'))
            ->line('Terus tingkatkan kemampuan Anda dan coba lagi di kesempatan berikutnya.')
            ->salutation('Salam, Tim Training');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Pendaftaran Training Ditolak',
            'message' => 'Maaf, pendaftaran Anda untuk training "' . $this->training->name . '" telah ditolak.',
            'training_id' => $this->training->id,
            'training_name' => $this->training->name,
            'action_url' => route('training.index'),
            'type' => 'training_rejected',
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

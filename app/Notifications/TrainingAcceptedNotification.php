<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrainingAcceptedNotification extends Notification
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
            ->subject('Pendaftaran Training Diterima')
            ->greeting('Selamat ' . $notifiable->name . '!')
            ->line('Pendaftaran Anda untuk training "' . $this->training->name . '" telah diterima.')
            ->line('Selamat bergabung! Training akan segera dimulai.')
            ->action('Lihat Training', route('training.home', $this->training->id))
            ->line('Persiapkan diri Anda untuk mengikuti training dengan baik.')
            ->salutation('Salam, Tim Training');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Pendaftaran Training Diterima',
            'message' => 'Selamat! Pendaftaran Anda untuk training "' . $this->training->name . '" telah diterima.',
            'training_id' => $this->training->id,
            'training_name' => $this->training->name,
            'action_url' => route('training.home', $this->training->id),
            'type' => 'training_accepted',
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

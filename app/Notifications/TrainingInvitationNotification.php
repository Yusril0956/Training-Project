<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrainingInvitationNotification extends Notification
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
            ->subject('Undangan Training Baru')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Anda telah ditambahkan ke training "' . $this->training->name . '"')
            ->line('Silakan klik tombol di bawah untuk melihat detail training.')
            ->action('Lihat Training', route('training.detail', $this->training->id))
            ->line('Terima kasih telah bergabung dengan training ini!')
            ->salutation('Salam, Tim Training');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Undangan Training Baru',
            'message' => 'Anda telah ditambahkan ke training "' . $this->training->name . '"',
            'training_id' => $this->training->id,
            'training_name' => $this->training->name,
            'action_url' => route('training.detail', $this->training->id),
            'type' => 'training_invitation',
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

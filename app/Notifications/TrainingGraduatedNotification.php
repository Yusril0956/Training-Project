<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrainingGraduatedNotification extends Notification
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
            ->subject('Selamat! Anda Telah Lulus Training')
            ->greeting('Selamat ' . $notifiable->name . '!')
            ->line('Selamat! Anda telah lulus dari training "' . $this->training->name . '"')
            ->line('Sertifikat Anda telah tersedia dan dapat diunduh.')
            ->action('Lihat Sertifikat', route('mysertifikat'))
            ->line('Terima kasih telah mengikuti training ini dengan baik.')
            ->line('Semoga ilmu yang didapat bermanfaat untuk karir Anda.')
            ->salutation('Salam, Tim Training');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Selamat! Anda Telah Lulus Training',
            'message' => 'Selamat! Anda telah lulus dari training "' . $this->training->name . '" dan menerima sertifikat.',
            'training_id' => $this->training->id,
            'training_name' => $this->training->name,
            'action_url' => route('mysertifikat'),
            'type' => 'training_graduated',
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

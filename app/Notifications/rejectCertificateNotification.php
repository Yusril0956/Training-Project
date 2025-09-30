<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class rejectCertificateNotification extends Notification
{
    use Queueable;

    protected $certificate;

    /**
     * Create a new notification instance.
     */
    public function __construct($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Sertifikat Ditolak',
            'message' => 'Sertifikat ' . $this->certificate->activity_name . ' telah ditolak. Data sertifikat anda telah dihapus.',
            'certificate_id' => $this->certificate->id,
            'certificate_name' => $this->certificate->name,
            'action_url' => route('mysertifikat'),
            'type' => 'certificate_rejected',
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

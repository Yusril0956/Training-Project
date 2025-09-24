<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskSubmissionNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $submission;

    /**
     * Create a new notification instance.
     */
    public function __construct($task, $submission)
    {
        $this->task = $task;
        $this->submission = $submission;
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
            ->subject('Tugas Baru Disubmit')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Tugas "' . $this->task->title . '" telah disubmit oleh ' . $this->submission->user->name)
            ->line('Silakan klik tombol di bawah untuk meninjau tugas yang disubmit.')
            ->action('Tinjau Tugas', route('training.showTasks', [$this->task->training_id, $this->task->id]))
            ->line('Mohon segera meninjau dan memberikan feedback pada tugas ini.')
            ->salutation('Salam, Tim Training');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Tugas Baru Disubmit',
            'message' => 'Tugas "' . $this->task->title . '" telah disubmit oleh ' . $this->submission->user->name,
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'training_id' => $this->task->training_id,
            'action_url' => route('training.showTasks', [$this->task->training_id, $this->task->id]),
            'type' => 'task_submission',
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

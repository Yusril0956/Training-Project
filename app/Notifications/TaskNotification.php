<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use App\Models\Tasks;

class TaskNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     */
    public function __construct(Tasks $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $training = $this->task->training;
        $taskUrl = route('training.task.detail', [$training->id, $this->task->id]);

        return (new MailMessage)
            ->subject("Tugas Baru: {$this->task->title}")
            ->greeting("Halo {$notifiable->name}!")
            ->line("Tugas baru telah ditambahkan ke training **{$training->name}**.")
            ->line("**Judul Tugas:** {$this->task->title}")
            ->line("**Deskripsi:** " . Str::limit($this->task->description, 100))
            ->line("**Deadline:** " . $this->task->deadline->format('d M Y H:i'))
            ->action('Lihat Tugas', $taskUrl)
            ->line('Silakan selesaikan tugas sebelum batas waktu yang ditentukan.')
            ->salutation('Salam, Tim Training');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Tugas Baru Ditambahkan',
            'message' => "Tugas '{$this->task->title}' telah ditambahkan ke training '{$this->task->training->name}'",
            'type' => 'new_task',
            'task_id' => $this->task->id,
            'training_id' => $this->task->training_id,
            'deadline' => $this->task->deadline->format('Y-m-d H:i:s'),
            'action_url' => route('training.task.detail', [$this->task->training_id, $this->task->id]),
        ];
    }
    
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}

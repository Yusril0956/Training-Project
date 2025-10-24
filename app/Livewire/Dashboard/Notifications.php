<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class Notifications extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification && $notification->notifiable_id === Auth::id()) {
            $notification->update(['read_at' => now()]);
        }
    }

    public function markAllAsRead()
    {
        Notification::where('notifiable_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        session()->flash('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    public function render()
    {
        $user = Auth::user();
        $notifications = Notification::where('notifiable_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('livewire.dashboard.notifications', [
            'notifications' => $notifications,
        ])->layout('layouts.dashboard', ['title' => 'Notifikasi']);
    }
}

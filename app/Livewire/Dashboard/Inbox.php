<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class Inbox extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nama_pengirim = '';
    public $pesan = '';
    protected $rules = [
        'nama_pengirim' => 'required|string|max:100',
        'pesan' => 'required|string',
    ];

    public function submitFeedback()
    {
        $this->validate();

        try {
            Feedback::create([
                'nama_pengirim' => $this->nama_pengirim,
                'pesan' => $this->pesan,
            ]);

            session()->flash('success', 'Feedback berhasil dikirim!');
            $this->reset(['nama_pengirim', 'pesan']);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengirim feedback!');
        }
    }

    public function render()
    {
        $feedback = Feedback::paginate(10);

        return view('livewire.dashboard.inbox', [
            'feedback' => $feedback,
        ])->layout('layouts.dashboard', ['title' => 'Inbox']);
    }
}

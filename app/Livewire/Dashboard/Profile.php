<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\User;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $nik;
    public $password;
    public $password_confirmation;
    public $avatar;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nik' => 'required|numeric|digits:6',
        'password' => 'nullable|min:6|confirmed',
        'password_confirmation' => 'nullable|min:6',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->nik = $this->user->nik;
    }

    public function updateProfile()
    {
        $this->validateOnly(['name', 'email', 'nik']);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'nik' => $this->nik,
        ]);

        session()->flash('success', 'Profile berhasil diperbarui!');
        $this->dispatch('closeModal', 'modal-edit-profile');
    }

    public function updatePassword()
    {
        $this->validateOnly(['password', 'password_confirmation']);

        if ($this->password) {
            $this->user->password = Hash::make($this->password);
            $this->user->save();

            session()->flash('success', 'Password berhasil diubah!');
            $this->password = null;
            $this->password_confirmation = null;
            $this->dispatch('closeModal', 'modal-password');
        }
    }

    public function updateAvatar()
    {
        $this->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($this->avatar) {
            $filename = 'avatar_' . $this->user->id . '.' . $this->avatar->getClientOriginalExtension();
            $path = $this->avatar->storeAs('avatars', $filename, 'public');

            if ($path) {
                $this->user->avatar_url = 'storage/avatars/' . $filename;
                $this->user->save();

                session()->flash('success', 'Avatar berhasil diubah!');
                $this->avatar = null;
                $this->dispatch('closeModal', 'modal-avatar');
            } else {
                session()->flash('error', 'Gagal upload file!');
            }
        }
    }

    public function deleteAvatar()
    {
        if ($this->user->avatar_url) {
            $filePath = str_replace('storage/', 'app/public/', $this->user->avatar_url);
            $fullPath = storage_path($filePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $this->user->avatar_url = null;
        $this->user->save();

        session()->flash('success', 'Avatar berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}

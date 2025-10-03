<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public $role = '';

    protected $paginationTheme = 'bootstrap'; // Biar cocok sama Tabler

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke page 1 kalau search berubah
    }

    public function updatingRole()
    {
        $this->resetPage(); // Reset ke page 1 kalau role berubah
    }

    public function resetFilters()
    {
        $this->reset(['search', 'role']);
        $this->resetPage();
    }

        public function render()
    {
        $users = User::query()
            ->with('roles')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->role, function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', $this->role);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.user-search', [
            'users' => $users,
        ]);
    }
}

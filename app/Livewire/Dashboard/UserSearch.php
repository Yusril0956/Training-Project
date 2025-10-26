<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use App\Services\AuthService;

class UserSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public $role = '';
    public $perPage = 10;

    // Modal state
    public $showModal = false;
    public $modalMode = 'create';
    public $userId = null;
    public $name, $email, $password, $nik, $roleInput;

    protected $authService;
    protected $paginationTheme = 'bootstrap';

    // Validation rules
    protected function rules()
    {
        $uniqueEmail = $this->userId
            ? 'unique:users,email,' . $this->userId
            : 'unique:users,email';

        return [
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:6',
            'email' => ['required', 'email', 'max:255', $uniqueEmail],
            'roleInput' => 'required|in:Super Admin,Admin,User',
            // 'status' => 'required|in:active,inactive',
        ];
    }

    public function boot(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingRole()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'role']);
        $this->resetPage();
    }

    // CRUD Modal
    public function showCreateModal()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'nik', 'roleInput']);
        $this->modalMode = 'create';
        $this->showModal = true;
    }

    public function showEditModal($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nik = $user->nik;
        $this->roleInput = $user->role ?? 'User';
        // $this->status = $user->status ?? 'active';
        $this->password = '';
        $this->modalMode = 'edit';
        $this->showModal = true;
    }

    public function saveUser()
    {
        $this->validate();

        if ($this->modalMode === 'create') {
            $this->authService->createUser([
                'name' => $this->name,
                'email' => $this->email,
                'nik' => $this->nik,
                'password' => $this->nik, // Use NIK as default password
                'role' => $this->roleInput,
            ]);
            session()->flash('success', 'User berhasil ditambahkan.');
        } else {
            $this->authService->updateUser($this->userId, [
                'name' => $this->name,
                'email' => $this->email,
                'nik' => $this->nik,
                'role' => $this->roleInput,
            ]);
            session()->flash('success', 'User berhasil diupdate.');
        }

        $this->showModal = false;
        $this->resetPage();
        $this->clearCache();
    }

    public function deleteUser($id)
    {
        if (!$this->authService->deleteUser($id)) {
            session()->flash('error', 'Akun super admin tidak dapat dihapus!');
            return;
        }
        session()->flash('success', 'User berhasil dihapus.');
        $this->clearCache();
        $this->resetPage();
    }

    protected function clearCache()
    {
        Cache::flush();
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->role) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', $this->role);
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('livewire.dashboard.user-search', [
            'users' => $users,
        ]);
    }
}

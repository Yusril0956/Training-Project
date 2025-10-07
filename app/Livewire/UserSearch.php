<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;

class UserSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public $role = '';
    public $perPage = 10;

    // Modal state
    public $showModal = false;
    public $modalMode = 'create'; // create|edit
    public $userId = null;
    public $name, $email, $password, $nik, $roleInput;

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
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'nik' => $this->nik,
                'password' => bcrypt($this->nik),
                // 'role' => $this->roleInput,
                // 'status' => $this->status,
            ]);
            $role = Role::where('name', $this->roleInput)->first();
            if ($role) {
                $user->roles()->attach($role->id);
            }
            session()->flash('success', 'User berhasil ditambahkan.');
        } else {
            $user = User::findOrFail($this->userId);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->nik = $this->nik;
            // $user->role = $this->roleInput;
            // $user->status = $this->status;
            // if ($this->password) $user->password = bcrypt($this->password);
            $user->save();
            $role = Role::where('name', $this->roleInput)->first();
            if ($role) {
                $user->roles()->sync([$role->id]);
            }
            session()->flash('success', 'User berhasil diupdate.');
        }

        $this->showModal = false;
        $this->resetPage();
        $this->clearCache();
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'Super Admin') {
            session()->flash('error', 'Akun super admin tidak dapat dihapus!');
            return;
        }
        $user->delete();
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

        return view('livewire.user-search', [
            'users' => $users,
        ]);
    }
}

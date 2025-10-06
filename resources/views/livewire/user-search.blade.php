<div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="search" class="form-label">Cari User</label>
                    <div class="input-group">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg></span>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Cari berdasarkan nama atau email...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="role" class="form-label">Filter Role</label>
                    <select wire:model.live="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-outline-secondary w-100" wire:click="resetFilters">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table table-striped table-hover" wire:loading.class="opacity-50" wire:target="search,role">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck('name')->first() ?? 'User' }}</td>
                                <td>{{ $user->created_at->format('F d, Y') }}</td>
                                <td>
                                    @if (Auth::id() !== $user->id && !$user->hasRole('Super Admin'))
                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    @else
                                        <span class="text-muted">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada user ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

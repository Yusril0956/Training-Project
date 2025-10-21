<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Tambah Peserta
                    </h2>
                    <div class="text-muted mt-1">
                        Pelatihan: <strong>{{ $training->name }}</strong>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <a href="{{ route('training.members.index', $training->id) }}" class="btn btn-outline-secondary" wire:navigate>
                        <i class="ti ti-arrow-left me-1"></i>
                        Kembali ke Daftar Peserta
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <form wire:submit.prevent="addMembers">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pilih Calon Peserta</h3>
                        </div>

                    <div wire:loading.class.delay="opacity-50" wire:target="addMembers">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="w-1">
                                            <input wire:model.live="selectAll" class="form-check-input" type="checkbox"
                                                aria-label="Pilih semua peserta">
                                        </th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>NIK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr wire:key="user-{{ $user->id }}">
                                            <td>
                                                <input wire:model.live="selectedUsers" class="form-check-input"
                                                    type="checkbox" value="{{ $user->id }}"
                                                    id="user-{{ $user->id }}">
                                            </td>
                                            <td>
                                                <label for="user-{{ $user->id }}" class="form-check-label d-block cursor-pointer">
                                                    {{ $user->name }}
                                                </label>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->nik ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="ti ti-users-off d-block mb-2" style="font-size: 2rem;"></i>
                                                Semua pengguna sudah terdaftar di pelatihan ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{ route('training.members.index', $training->id) }}" class="btn" wire:navigate>
                            Batal
                        </a>
                        
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            {{ empty($selectedUsers) ? 'disabled' : '' }}>
                            
                            <span wire:loading.inline wire:target="addMembers">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                Menambahkan...
                            </span>
                            
                            <span wire:loading.remove wire:target="addMembers">
                                <i class="ti ti-plus me-1"></i>
                                Tambah {{ count($selectedUsers) > 0 ? count($selectedUsers) : '' }} Peserta
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
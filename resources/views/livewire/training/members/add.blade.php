<div>
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Members', 'url' => route('training.members.index', $training->id)],
                    ['title' => 'Add Members', 'url' => '#'],
                ],
            ])

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @php session()->forget('success'); @endphp {{-- Hapus setelah ditampilkan --}}
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @php session()->forget('error'); @endphp {{-- Hapus setelah ditampilkan --}}
            @endif

            <div class="card mb-3">
                <div class="card-body">
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                        <div class="mb-3 mb-sm-0">
                            <h2 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg> Tambah Peserta</h2>
                            <p class="text-muted mb-0">Pilih calon peserta untuk pelatihan
                                <strong>{{ $training->name }}</strong>.
                            </p>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <a href="{{ route('training.members.index', $training->id) }}"
                                class="btn btn-outline-secondary" wire:navigate>
                                <i class="ti ti-arrow-left me-1"></i>
                                Kembali ke Daftar Peserta
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="addMembers">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pilih Calon Peserta</h3>
                    </div>

                    <div wire:loading.class.delay="opacity-50" wire:target="addMembers">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="w-1">
                                            <input wire:model.live="selectAll" class="form-check-input" type="checkbox"
                                                aria-label="Pilih semua peserta">
                                        </th>
                                        <th>Nama</th>
                                        <th class="d-none d-sm-table-cell">Email</th>
                                        <th class="d-none d-md-table-cell">NIK</th>
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
                                                <label for="user-{{ $user->id }}"
                                                    class="form-check-label d-block cursor-pointer">
                                                    {{ $user->name }}
                                                </label>
                                            </td>
                                            <td class="d-none d-sm-table-cell">{{ $user->email }}</td>
                                            <td class="d-none d-md-table-cell">{{ $user->nik ?? '-' }}</td>
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

                    <div class="card-footer d-flex flex-column flex-sm-row justify-content-end gap-2">
                        <a href="{{ route('training.members.index', $training->id) }}"
                            class="btn btn-outline-secondary" wire:navigate>
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

<div>
    <div class="d-flex justify-content-end mb-3">
        <button wire:click="create" class="btn btn-primary">Tambah Pelatihan</button>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($showCreateForm)
    <div class="card mb-3">
        <div class="card-body">
            <form wire:submit="{{ $editingId ? 'update' : 'store' }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pelatihan</label>
                        <input type="text" wire:model="name" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Pelatihan</label>
                        <select wire:model="jenis_training_id" class="form-select" required>
                            <option value="">Pilih Jenis</option>
                            @foreach($jenisTrainings as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea wire:model="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select wire:model="status" class="form-select">
                            <option value="open">Open</option>
                            <option value="close">Close</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">{{ $editingId ? 'Update' : 'Simpan' }}</button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="search" class="form-label">Cari Training</label>
                    <div class="input-group">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 0 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg></span>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Cari berdasarkan nama atau deskripsi...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="jenis" class="form-label">Filter Jenis</label>
                    <select wire:model.live="jenis" class="form-select">
                        <option value="">Semua Jenis</option>
                        <option value="General Knowledge">General Knowledge</option>
                        <option value="Mandatory">Mandatory</option>
                        <option value="Customer Requested">Customer Requested</option>
                        <option value="Lisensi">Lisensi</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-outline-secondary w-100" wire:click="resetFilter">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Daftar Pelatihan -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">No</th>
                            <th>Nama Pelatihan</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Periode</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trainings as $i => $t)
                            <tr>
                                <td>{{ $trainings->firstItem() + $i }}</td>
                                <td>{{ $t->name }}</td>
                                <td>
                                    <span class="badge bg-azure-lt">{{ $t->jenisTraining->name }}</span>
                                </td>
                                <td>
                                    @if ($t->status === 'open')
                                        <span class="badge bg-green-lt">Open</span>
                                    @else
                                        <span class="badge bg-red-lt">Close</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($t->detail)
                                        {{ \Carbon\Carbon::parse($t->detail->start_date)->format('d M Y') }}
                                        &ndash;
                                        {{ \Carbon\Carbon::parse($t->detail->end_date)->format('d M Y') }}
                                    @else
                                        <span class="text-muted">Belum dijadwalkan</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-list">
                                        <a href="{{ route('training.home', $t->id) }}" class="btn btn-sm btn-info btn-pill"
                                            title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>
                                        <button wire:click="edit({{ $t->id }})" class="btn btn-sm btn-warning btn-pill" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button wire:click="destroy({{ $t->id }})" class="btn btn-sm btn-danger btn-pill"
                                            title="Hapus" onclick="return confirm('Yakin ingin menghapus pelatihan ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada pelatihan ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $trainings->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

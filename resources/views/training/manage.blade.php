@extends('layouts.dashboard')
@section('title', 'Manajemen Pelatihan')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Page Header -->
            <div class="d-flex mb-4">
                <div class="flex-fill">
                    <h2 class="page-title">📚 Manajemen Pelatihan</h2>
                    <p class="text-muted">
                        Buat, edit, dan hapus pelatihan untuk semua jenis: General Knowledge, Mandatory, Customer Requested,
                        dan License.
                    </p>
                </div>
                <div class="ms-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddTraining">
                        <i class="ti ti-plus me-1"></i> Tambah Pelatihan
                    </button>
                </div>
            </div>

            <!-- Filter & Search -->
            <form method="GET" action="{{ route('admin.training.manage') }}" class="card mb-4">
                <div class="card-body row g-2 align-items-center">
                    <div class="col-md-3">
                        <select name="jenis" class="form-select">
                            <option value="">🔍 Semua Jenis</option>
                            @foreach ($jenisTraining as $jenis)
                                <option value="{{ $jenis->id }}" {{ request('jenis') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->name }} ({{ $jenis->code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama pelatihan..."
                            value="{{ request('search') }}" />
                    </div>
                    <div class="col-auto ms-auto">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="ti ti-search me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.training.manage') }}" class="btn btn-outline-secondary ms-2">
                            <i class="ti ti-refresh me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

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
                                    <th>Kategori</th>
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
                                        <td>{{ $t->category }}</td>
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
                                                <a href="{{ route('training.detail', $t->id) }}" class="btn btn-sm btn-info btn-pill"
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
                                                <a href="{{ route('training.settings', $t->name) }}"
                                                    class="btn btn-sm btn-warning btn-pill" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.training.destroy', $t->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus pelatihan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-pill" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </form>
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
    </div>

    <!-- Modal: Tambah Pelatihan -->
    <div class="modal modal-blur fade" id="modalAddTraining" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('training.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">➕ Tambah Pelatihan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Pelatihan</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Contoh: Leadership" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Pelatihan</label>
                                <select name="jenisTraining" class="form-select" required>
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($jenisTraining as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->name }} ({{ $jenis->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="category" class="form-control"
                                    placeholder="Contoh: Risk Management" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat pelatihan"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="open" selected>Open</option>
                                    <option value="close">Close</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Mulai</label>
                                <input type="date" name="start_date" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Selesai</label>
                                <input type="date" name="end_date" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-check me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

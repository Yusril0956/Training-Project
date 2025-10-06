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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg> Tambah Pelatihan
                    </button>
                </div>
            </div>

            <livewire:training-search page-type="admin" />

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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

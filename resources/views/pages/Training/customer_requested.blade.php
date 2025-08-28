@extends('layouts.app')
@section('title', 'Customer Requested')

@section('content')
    <div class="page-body">
        <div class="container-xl">
                @include('partials._breadcrumb', [
                    'items' => [
                        ['title' => 'Training', 'url' => route('training.index')],
                        ['title' => 'Customer Requested', 'url' => route('customer.requested')]
                    ]
                ])
            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-body text-center py-4">
                    <h2 class="card-title">Customer Requested Training</h2>
                    <p class="card-subtitle text-muted">Daftar pelatihan yang diajukan langsung oleh klien atau mitra kerja
                    </p>
                </div>
            </div>

            <!-- Filter & Actions -->
            <div class="card mb-3">
                <div class="card-body">
                    <form class="row g-2">
                        <div class="col-md-4">
                            <select class="form-select">
                                <option value="">Filter Kategori</option>
                                <option value="technical">Teknis</option>
                                <option value="safety">Keselamatan</option>
                                <option value="compliance">Kepatuhan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select">
                                <option value="">Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Disetujui</option>
                                <option value="completed">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="#" class="btn btn-primary">+ Tambah Permintaan</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Daftar Training -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Judul Pelatihan</th>
                                    <th>Kategori</th>
                                    <th>Klien</th>
                                    <th>Status</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pelatihan Perawatan CN235</td>
                                    <td>Teknis</td>
                                    <td>PT Aviasi Nusantara</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>2025-08-20</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Detail</a>
                                        <a href="#" class="btn btn-sm btn-secondary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Audit Kepatuhan ISO 9001</td>
                                    <td>Kepatuhan</td>
                                    <td>PT AeroCert</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>2025-07-15</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Detail</a>
                                        <a href="#" class="btn btn-sm btn-secondary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Simulasi Evakuasi Darurat</td>
                                    <td>Keselamatan</td>
                                    <td>PT SkyShield</td>
                                    <td><span class="badge bg-primary">Approved</span></td>
                                    <td>2025-08-01</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Detail</a>
                                        <a href="#" class="btn btn-sm btn-secondary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Optional: Form Tambah Permintaan -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Tambah Permintaan Pelatihan</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Judul Pelatihan</label>
                            <input type="text" class="form-control" placeholder="Contoh: Pelatihan Sistem Avionik">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select">
                                <option value="">Pilih Kategori</option>
                                <option value="technical">Teknis</option>
                                <option value="safety">Keselamatan</option>
                                <option value="compliance">Kepatuhan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Klien</label>
                            <input type="text" class="form-control" placeholder="Contoh: PT Dirgantara Mitra">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="4" placeholder="Detail permintaan pelatihan..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

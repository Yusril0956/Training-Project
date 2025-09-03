@extends('layouts.app')
@section('title', 'Customer Requested')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Customer Requested', 'url' => route('customer.requested')],
                ],
            ])
            <!-- Hero Section -->
            <div class="card mb-3">
                <div class="card-body text-center py-4">
                    <h2 class="card-title">Customer Requested Training</h2>
                    <p class="card-subtitle text-muted">Daftar pelatihan yang diajukan langsung oleh klien atau mitra kerja
                    </p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Daftar training yang tersedia</h3>
                </div>
            </div>
            {{-- <div class="card-body"> --}}
            <div class="row row-cards mb-3">
                @foreach ($approvedTrainings as $training)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">
                            <img src="{{ $training->image_url ?? asset('images/default-training.jpg') }}"
                                class="card-img-top" alt="Gambar Kelas">
                            <div class="card-body">
                                <h4 class="card-title">{{ $training->nama }}</h4>
                                <p class="text-muted">{{ Str::limit($training->deskripsi, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin'))
                                        <a href="{{ route('detail.training', $training->id) }}"
                                            class="btn btn-sm btn-secondary">Detail</a>
                                    @endif
                                    <a href="{{ route('cr.page', $training->id) }}" class="btn btn-sm btn-primary">Masuk
                                        Training</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($approvedTrainings->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Belum ada kelas training yang disetujui.
                        </div>
                    </div>
                @endif
            </div>
            {{-- </div> --}}
            {{-- </div> --}}

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
                            <a href="#add-training-request" class="btn btn-primary">+ Tambah Permintaan</a>
                        </div>
                    </form>
                </div>
            </div>

            @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin'))
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Permintaan</h3>
                    </div>
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
                                    @foreach ($trainings as $index => $training)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $training->nama }}</td>
                                            <td>{{ ucfirst($training->kategori) }}</td>
                                            <td>{{ $training->klien }}</td>
                                            <td>
                                                @if ($training->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif ($training->status === 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif ($training->status === 'approved')
                                                    <span class="badge bg-primary">Approved</span>
                                                @elseif ($training->status === 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>{{ $training->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('training.detail', $training->id) }}"
                                                    class="btn btn-sm btn-info">Detail</a>
                                                <a href="#" class="btn btn-sm btn-secondary">Edit</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#success-{{ $training->id }}">
                                                    Action
                                                </button>
                                            </td>
                                        </tr>
                                        @include('components._modal', [
                                            'modalId' => $training->id,
                                            'modalTitle' => $modalTitle,
                                            'modalDescription' => $modalDescription,
                                            'modalButton1' => $modalButton1,
                                            'modalButton2' => $modalButton2,
                                            'trainingId' => $training->id,
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row row-cards">
                <!-- Informasi Permintaan -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Permintaan</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama Pelatihan:</strong> {{ $training->title }}</p>
                            <p><strong>Klien:</strong> {{ $training->client_name }}</p>
                            <p><strong>Tanggal Permintaan:</strong> 2025-03-10</p>
                            <p><strong>Status:</strong> <span class="badge bg-warning">{{ $training->status }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Jadwal & PIC -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jadwal & PIC</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Jadwal:</strong> {{ $training->schedule ?? 'Belum ditentukan' }}</p>
                            <p><strong>Lokasi:</strong> {{ $training->location ?? '-' }}</p>
                            <p><strong>PIC Internal:</strong> {{ $training->pic_internal }}</p>
                            <p><strong>PIC Klien:</strong> {{ $training->pic_client }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Pendukung -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dokumen Pendukung</h3>
                        </div>
                        <div class="card-body">
                            @if (optional($training->documents)->count())
                                <ul>
                                    @foreach ($training->documents as $doc)
                                        <li><a href="{{ $doc->url }}" target="_blank">{{ $doc->name }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Tidak ada dokumen diunggah.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Feedback & Evaluasi -->
                @if ($training->status === 'Selesai')
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Evaluasi & Feedback</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('feedback.form', $training->id) }}" class="btn btn-primary">Isi
                                    Feedback</a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Aksi Admin -->
                @can('approve-training')
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-end">
                                <form method="POST" action="{{ route('training.approve', $training->id) }}">
                                    @csrf
                                    <button class="btn btn-success">Setujui Permintaan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>

            <!-- Optional: Form Tambah Permintaan -->
            <div class="card mt-4" id="add-training-request">
                <div class="card-header">
                    <h3 class="card-title">Tambah Permintaan Pelatihan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('training.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Judul Pelatihan</label>
                            <input type="text" class="form-control" name="nama"
                                placeholder="Contoh: Pelatihan Sistem Avionik">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Training</label>
                            <select class="form-select" name="jenis_training_id" required>
                                <option value="">Pilih Jenis Training</option>
                                @foreach ($jenisTrainings as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->kode }} - {{ $jenis->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="technical">Teknis</option>
                                <option value="safety">Keselamatan</option>
                                <option value="compliance">Kepatuhan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Klien</label>
                            <input type="text" class="form-control" name="klien"
                                placeholder="Contoh: PT Dirgantara Mitra">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="4" placeholder="Detail permintaan pelatihan..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

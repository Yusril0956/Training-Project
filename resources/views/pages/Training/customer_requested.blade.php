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
                @forelse($trainings as $training)
                    @php
                        // tanggal & jumlah peserta
                        $detail = $training->detail;
                        $joined = $training->members->count();
                        $capacity = $training->capacity ?? '-';
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">

                            {{-- Gambar Banner --}}
                            <img src="{{ $training->category_image ?? asset('images/default-training.jpg') }}"
                                class="card-img-top object-fit-cover" style="height: 180px;" alt="Gambar Training" />

                            <div class="card-body">
                                {{-- Judul & Deskripsi --}}
                                <h4 class="card-title">{{ $training->name }}</h4>

                                {{-- Badges --}}
                                <div class="mb-2">
                                    @if ($detail)
                                        <span class="badge bg-primary">
                                            {{ \Carbon\Carbon::parse($detail->start_date)->format('d M Y') }}
                                            &ndash;
                                            {{ \Carbon\Carbon::parse($detail->end_date)->format('d M Y') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning">Belum Dijadwalkan</span>
                                    @endif
                                    <span class="badge bg-primary">{{ $training->category ?? 'N/A' }}</span>
                                </div>

                                {{-- Participant Count --}}
                                <div class="d-flex mb-3">
                                    <small class="me-3">
                                        <i class="ti ti-users me-1"></i> {{ $joined }} peserta
                                    </small>
                                    @if (is_numeric($capacity))
                                        <small>
                                            <i class="ti ti-chart-pie me-1"></i>
                                            {{ $capacity - $joined }} slot tersisa
                                        </small>
                                    @endif
                                </div>

                                {{-- Aksi --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    @auth
                                        @php
                                            $member = $training->members->where('user_id', Auth::id())->first();
                                            $status = $member ? $member->status : 'none';
                                        @endphp

                                        @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']) || $status === 'accept')
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="offcanvas"
                                                data-bs-target="#detailCanvas-{{ $training->id }}">
                                                Details
                                            </button>
                                            <a href="{{ route('cr.page', $training->id) }}" class="btn btn-sm btn-primary">
                                                Lihat
                                            </a>
                                        @elseif ($status === 'pending')
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="offcanvas"
                                                data-bs-target="#detailCanvas-{{ $training->id }}">
                                                Details
                                            </button>
                                            <button class="btn btn-sm btn-warning" disabled>
                                                Pending
                                            </button>
                                        @else
                                            <form action="{{ route('training.self.register', $training->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary">Daftar</button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                            Login untuk Daftar
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Offcanvas Details --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="detailCanvas-{{ $training->id }}">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title">{{ $training->name }} – Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                            <p><strong>Deskripsi:</strong> {{ $training->description }}</p>
                            @if ($detail)
                                <p>
                                    <strong>Periode:</strong>
                                    {{ \Carbon\Carbon::parse($detail->start_date)->format('d M Y') }}
                                    hingga
                                    {{ \Carbon\Carbon::parse($detail->end_date)->format('d M Y') }}
                                </p>
                            @endif
                            <p><strong>Instansi:</strong> {{ $training->client ?? 'Internal' }}</p>
                            <p><strong>Jumlah Peserta:</strong> {{ $joined }}</p>

                            <hr>

                            <h6>Matriks Materi</h6>
                            <ul>
                                @foreach ($training->materis as $mat)
                                    <li>{{ $mat->title }}</li>
                                @endforeach
                                @if ($training->materis->isEmpty())
                                    <li class="text-muted">Belum ada materi</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Belum ada kelas training yang disetujui.
                        </div>
                    </div>
                @endforelse

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

                @if (Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
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
                                            <th>Status</th>
                                            <th>Tanggal Permintaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trainings as $index => $training)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $training->name }}</td>
                                                <td>{{ ucfirst($training->category) }}</td>
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
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#success-action-training-{{ $training->id }}">
                                                        Action
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('components._modal', [
                                                'modalId' => 'action-training-' . $training->id,
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
                                <input type="text" class="form-control" name="name"
                                    placeholder="Contoh: Pelatihan Sistem Avionik">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="category">
                                    <option value="">Pilih Kategori</option>
                                    <option value="technical">Teknis</option>
                                    <option value="safety">Keselamatan</option>
                                    <option value="compliance">Kepatuhan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Detail permintaan pelatihan..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

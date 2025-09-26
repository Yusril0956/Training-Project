{{-- resources/views/pages/training/user-list.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Training')

@push('style')
<style>
    .grayscale {
        filter: grayscale(100%);
        opacity: 0.6;
    }
    .opacity-50 {
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Hero / Header --}}
            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1">📚 Pilih Pelatihan</h2>
                        <p class="text-muted">Lihat dan daftar pelatihan yang tersedia untuk Anda.</p>
                    </div>
                </div>
            </div>

            {{-- Search --}}
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('training.index') }}" class="row g-3 align-items-end">
                        <div class="col-md-8">
                            <label for="search" class="form-label">Cari Pelatihan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-search"></i></span>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan nama atau deskripsi..." value="{{ $request->search }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="ti ti-search me-1"></i>Cari
                                </button>
                                <a href="{{ route('training.index') }}" class="btn btn-outline-secondary flex-fill">
                                    <i class="ti ti-x me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Grid Card --}}
            <div class="row row-cards">
                @forelse($trainings as $training)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm {{ $training->status === 'close' ? 'opacity-50 border-secondary' : '' }}">

                            {{-- Gambar Banner --}}
                            <img src="{{ $training->image_url ?? asset('images/default-training.jpg') }}"
                                class="card-img-top object-fit-cover {{ $training->status === 'close' ? 'grayscale' : '' }}" style="height: 160px;"
                                alt="Banner {{ $training->name }}" />

                            <div class="card-body">
                                {{-- Judul --}}
                                <h4 class="card-title">{{ $training->name }}</h4>
                                {{-- Deskripsi Singkat --}}
                                <p class="text-muted">{{ Str::limit($training->description, 80) }}</p>

                                {{-- Badges --}}
                                <div class="mb-2">
                                    @if ($training->detail)
                                        <span class="badge bg-blue text-blue-fg">
                                            {{ \Carbon\Carbon::parse($training->detail->start_date)->format('d M Y') }}
                                            &ndash;
                                            {{ \Carbon\Carbon::parse($training->detail->end_date)->format('d M Y') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning">Belum Dijadwalkan</span>
                                    @endif

                                    @if ($training->status === 'close')
                                        <span class="badge bg-danger text-danger-fg">Ditutup</span>
                                    @endif

                                    @php
                                        $currentStatus = $userStatuses[$training->id] ?? 'none';
                                    @endphp
                                    @if ($currentStatus === 'graduate')
                                        <span class="badge badge bg-green text-green-fg">Lulus</span>
                                    @elseif ($currentStatus === 'accept')
                                        <span class="badge bg-azure text-azure-fg">Diikuti</span>
                                    @elseif ($currentStatus === 'pending')
                                        <span class="badge bg-orange text-orange-fg">Menunggu</span>
                                    @endif
                                </div>

                                {{-- Aksi --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    @auth
                                        @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']) || $currentStatus === 'accept' || $currentStatus === 'graduate')
                                            <button class="btn btn-sm btn-outline-info btn-pill" data-bs-toggle="offcanvas"
                                                data-bs-target="#detailCanvas-{{ $training->id }}">
                                                Details
                                            </button>
                                            <a href="{{ route('training.home', $training->id) }}"
                                                class="btn btn-sm btn-primary btn-pill">
                                                Lihat
                                            </a>
                                        @elseif ($currentStatus === 'pending')
                                            <button class="btn btn-sm btn-outline-info btn-pill" data-bs-toggle="offcanvas"
                                                data-bs-target="#detailCanvas-{{ $training->id }}">
                                                Details
                                            </button>
                                            <button class="btn btn-sm btn-warning btn-pill" disabled>
                                                Pending
                                            </button>
                                        @elseif ($training->status === 'close')
                                            <button class="btn btn-sm btn-outline-info btn-pill" data-bs-toggle="offcanvas"
                                                data-bs-target="#detailCanvas-{{ $training->id }}">
                                                Details
                                            </button>
                                            <button class="btn btn-sm btn-secondary btn-pill" disabled>
                                                Ditutup
                                            </button>
                                        @else
                                            <form action="{{ route('training.self.register', $training->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary btn-pill">Daftar</button>
                                            </form>
                                        @endif
                                    @else
                                        @if ($training->status === 'close')
                                            <button class="btn btn-sm btn-secondary btn-pill" disabled>
                                                Ditutup
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-sm btn-primary btn-pill">
                                                Login untuk Daftar
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Belum ada pelatihan tersedia.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Offcanvas Details --}}
            @foreach ($trainings as $training)
                <div class="offcanvas offcanvas-end" tabindex="-1" id="detailCanvas-{{ $training->id }}">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">{{ $training->name }} – Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p><strong>Deskripsi:</strong> {{ $training->description }}</p>
                        @if ($training->detail)
                            <p>
                                <strong>Periode:</strong>
                                {{ \Carbon\Carbon::parse($training->detail->start_date)->format('d M Y') }}
                                hingga
                                {{ \Carbon\Carbon::parse($training->detail->end_date)->format('d M Y') }}
                            </p>
                        @endif
                        <p><strong>Jenis:</strong> {{ $training->jenisTraining->name ?? 'N/A' }}</p>
                        <p><strong>Jumlah Peserta:</strong> {{ $training->members->count() }}</p>

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
            @endforeach

            <div class="mt-4 d-flex justify-content-center">
                {{ $trainings->withQueryString()->links() }}
            </div>

        </div>
    </div>
@endsection

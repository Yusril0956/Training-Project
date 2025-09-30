{{-- resources/views/pages/training/user-list.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Training')

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
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="Cari berdasarkan nama atau deskripsi..." value="{{ $request->search }}">
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
                        <div
                            class="card shadow-sm {{ $training->status === 'close' ? 'bg-gray-500' : '' }}">

                            {{-- Banner dengan avatar seperti di index-old --}}
                            <div class="card-body text-center {{ $training->status === 'close' ? 'bg-gray-500' : '' }}">
                                <div class="mb-3">
                                    @php
                                        $code = $training->jenisTraining ? $training->jenisTraining->code : null;
                                        $icons = [
                                            'GK' =>
                                                '<svg  xmlns="http://www.w3.org/2000/svg"  width="80"  height="80"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>',
                                            'MD' =>
                                                '<svg  xmlns="http://www.w3.org/2000/svg"  width="80"  height="80"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shield"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /></svg>', // heart-rate-monitor
                                            'CR' =>
                                                '<svg  xmlns="http://www.w3.org/2000/svg"  width="80"  height="80"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-question"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M19 22v.01" /><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>',
                                            'LS' =>
                                                '<svg  xmlns="http://www.w3.org/2000/svg"  width="80"  height="80"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-id"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M15 8l2 0" /><path d="M15 12l2 0" /><path d="M7 16l10 0" /></svg>',
                                        ];
                                        $svgPath =
                                            $icons[$code] ??
                                            '<svg  xmlns="http://www.w3.org/2000/svg"  width="80"  height="80"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-question-mark"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4" /><path d="M12 19l0 .01" /></svg>'; // default box
                                        $avatarClasses = [
                                            'GK' => 'avatar avatar-xl bg-blue-lt text-blue',
                                            'MD' => 'avatar avatar-xl bg-red-lt text-red',
                                            'CR' => 'avatar avatar-xl bg-green-lt text-green',
                                            'LS' => 'avatar avatar-xl bg-yellow-lt text-yellow',
                                        ];
                                        $avatarClass = $avatarClasses[$code] ?? 'avatar avatar-xl bg-gray-lt text-gray';
                                    @endphp
                                    <span class="{{ $avatarClass }}">{!! $svgPath !!}</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title">{{ $training->name }}</h4>
                                <p class="text-muted">{{ Str::limit($training->description, 80) }}</p>

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
                                        <span class="badge bg-green text-green-fg">Lulus</span>
                                    @elseif ($currentStatus === 'accept')
                                        <span class="badge bg-azure text-azure-fg">Diikuti</span>
                                    @elseif ($currentStatus === 'pending')
                                        <span class="badge bg-orange text-orange-fg">Menunggu</span>
                                    @endif
                                </div>

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

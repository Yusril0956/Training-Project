@extends('layouts.app')
@section('title', 'Mandatory Training')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Breadcrumb --}}
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Training', 'url' => route('training.index')],
                ],
            ])

            {{-- Hero --}}
            <div class="card mb-3 text-center">
                <div class="card-body py-4">
                    <h2 class="card-title">Mandatory Training</h2>
                    <p class="text-muted">
                        Pelatihan yang diwajibkan perusahaan atau regulator untuk karyawan pada pekerjaan tertentu.
                    </p>
                </div>
            </div>

            {{-- Filter & Search --}}
            <form method="GET" action="#" class="card mb-4">
                <div class="card-body row g-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama pelatihan..."
                            value="{{ request('search') }}" />
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}"
                            placeholder="Filter tanggal mulai" />
                    </div>
                    <div class="col-auto ms-auto">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg> Filter
                        </button>
                        <a href="#" class="btn btn-secondary ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                            </svg> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- Daftar Training --}}
            <div class="row row-cards">
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
                                    <span class="badge bg-primay">{{ $training->category ?? 'N/A' }}</span>
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
                                            $status = $userStatuses[$training->id] ?? 'none';
                                        @endphp

                                        @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']) || $status === 'accept')
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="offcanvas"
                                                data-bs-target="#detailCanvas-{{ $training->id }}">
                                                Details
                                            </button>
                                            <a href="{{ route('training.home', $training->id) }}"
                                                class="btn btn-sm btn-primary">
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
                                            <form action="{{ route('training.self.register', $training->id) }}" method="POST"
                                                style="display:inline;">
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
                            Belum ada {{ strtolower($jenis->name ?? 'training') }} tersedia.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $trainings->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection

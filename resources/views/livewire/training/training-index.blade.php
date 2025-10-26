<div class="page-body">
    <div class="container-xl">
        {{-- Hero / Header --}}
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title mb-1">Pilih Pelatihan</h2>
                    <p class="text-muted">Lihat dan daftar pelatihan yang tersedia untuk Anda.</p>
                </div>
                @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                    <a href="{{ route('admin.training.manage') }}" class="btn btn-primary">
                        Manage
                    </a>
                @endif
            </div>
        </div>

        <div>
            {{-- Card Pencarian dan Filter --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Filter Pelatihan</h4>
                    <div class="row g-3">
                        {{-- Kolom Cari --}}
                        <div class="col-md-6 col-lg-5">
                            <label for="search" class="form-label">Cari Pelatihan</label>
                            <div class="input-icon">
                                <input type="text" wire:model.live="search" class="form-control"
                                    placeholder="Cari berdasarkan nama atau deskripsi...">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        {{-- Kolom Filter Jenis --}}
                        <div class="col-md-3 col-lg-4">
                            <label for="jenis" class="form-label">Jenis Pelatihan</label>
                            <select wire:model.live="jenis" class="form-select">
                                <option value="">Semua Jenis</option>
                                <option value="General Knowledge">General Knowledge</option>
                                <option value="Mandatory">Mandatory</option>
                                <option value="Customer Requested">Customer Requested</option>
                                <option value="Lisensi">Lisensi</option>
                            </select>
                        </div>

                        {{-- Kolom Reset Filter --}}
                        <div class="col-md-3 col-lg-3 d-flex align-items-end">
                            <button class="btn btn-outline-secondary w-100" wire:click="resetFilter">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                </svg>
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grid Card Pelatihan --}}
            <div class="row row-cards">
                @forelse($trainings as $training)
                    @php
                        $code = $training->jenisTraining?->code;
                        $isClosed = $training->status === 'close';
                        $statusBadge = $userStatuses[$training->id] ?? 'none';

                        // [MODIFIED] Definisi ikon menggunakan string SVG lengkap
                        $icons = [
                            'GK' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>',
                            'MD' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shield"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /></svg>',
                            'CR' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-question"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M19 22v.01" /><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>',
                            'LS' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-id"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M15 8l2 0" /><path d="M15 12l2 0" /><path d="M7 16l10 0" /></svg>',
                        ];

                        $defaultIcon =
                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-question-mark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 8a3.5 3.5 0 0 1 3.5 -3h1a3.5 3.5 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path><path d="M12 19l0 .01"></path></svg>';

                        $iconSvg = $icons[$code] ?? $defaultIcon;

                        // Logika untuk warna avatar
                        $classes = [
                            'GK' => 'bg-blue-lt',
                            'MD' => 'bg-red-lt',
                            'CR' => 'bg-green-lt',
                            'LS' => 'bg-yellow-lt',
                        ];
                        $avatarClass = $classes[$code] ?? 'bg-gray-lt';

                        // Logika untuk Ribbon Status
                        $ribbonText = '';
                        $ribbonClass = '';
                        if ($isClosed) {
                            $ribbonText = 'Ditutup';
                            $ribbonClass = 'bg-danger';
                        } elseif ($statusBadge === 'graduate') {
                            $ribbonText = 'Anda Lulus';
                            $ribbonClass = 'bg-green';
                        }
                    @endphp

                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="card d-flex flex-column h-100 w-100 shadow-sm">
                            @if ($ribbonText)
                                <div class="ribbon {{ $ribbonClass }}">{{ $ribbonText }}</div>
                            @endif

                            <div class="card-header">
                                <div class="d-flex align-items-center w-100">
                                    <span class="avatar avatar-md me-3 {{ $avatarClass }}">
                                        {{-- [MODIFIED] Menampilkan SVG langsung dari variabel --}}
                                        {!! $iconSvg !!}
                                    </span>
                                    <div class="flex-grow-1">
                                        <h4 class="card-title text-truncate mb-0">{{ Str::limit($training->name, 30) }}
                                        </h4>
                                        <div class="text-secondary text-truncate">
                                            {{ $training->jenisTraining->name ?? 'Tidak Diketahui' }}
                                        </div>
                                        @if ($training->instructor)
                                            <div class="text-secondary small">
                                                Instruktur: {{ $training->instructor->name }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-body flex-grow-1">
                                <p class="text-secondary">{{ Str::limit($training->description, 125) }}</p>
                                <div class="mt-auto pt-3 border-top">
                                    <div class="d-flex align-items-center text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar-event me-2" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11l16 0" />
                                            <path d="M8 15h2v2h-2z" />
                                        </svg>
                                        <span>
                                            @if ($training->start_date)
                                                {{ \Carbon\Carbon::parse($training->start_date)->format('d M') }}
                                                -
                                                {{ \Carbon\Carbon::parse($training->end_date)->format('d M Y') }}
                                            @else
                                                Belum Dijadwalkan
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                @auth
                                    @if ($statusBadge === 'accept' || $statusBadge === 'graduate' || Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                                        <a href="{{ route('training.home', $training->id) }}"
                                            class="btn btn-primary w-100">Lihat
                                            Detail</a>
                                    @elseif ($statusBadge === 'pending')
                                        <button class="btn btn-warning w-100" disabled>Menunggu Persetujuan</button>
                                    @elseif ($isClosed)
                                        <button class="btn btn-secondary w-100" disabled>Pendaftaran Ditutup</button>
                                    @else
                                        <button wire:click="register({{ $training->id }})"
                                            class="btn btn-success w-100">Daftar Training</button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100">Login untuk Daftar</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 9v4" />
                                    <path d="M12 16v.01" />
                                </svg>
                            </div>
                            <p class="empty-title">Tidak ada pelatihan ditemukan</p>
                            <p class="empty-subtitle text-secondary">
                                Coba ubah kata kunci pencarian atau filter Anda untuk menemukan hasil yang lebih baik.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $trainings->links() }}
            </div>
        </div>
    </div>
</div>

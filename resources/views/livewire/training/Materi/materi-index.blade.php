<div class="page-body">
    <div class="container-xl">

        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => Str::limit($training->name, 10), 'url' => route('training.home', $training->id)],
                ['title' => 'Materi', 'url' => route('training.materi.index', $training->id)],
            ],
        ])

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-book me-1">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6l0 13" />
                        <path d="M12 6l0 13" />
                        <path d="M21 6l0 13" />
                    </svg>
                    Daftar Materi Pelatihan
                </h3>
                <div class="ms-auto d-flex align-items-center gap-2">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Cari materi..."
                            wire:model.live.debounce.300ms="search">
                        <span class="input-icon-addon" wire:loading wire:target="search">
                            <div class="spinner-border spinner-border-sm text-muted" role="status"></div>
                        </span>
                    </div>

                    @if ($isAdmin)
                        <a href="{{ route('training.materi.create', $trainingId) }}" class="btn btn-primary d-none d-sm-inline-block"
                            wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Materi
                        </a>
                    @endif
                </div>
            </div>

            <div class="list-group list-group-flush" wire:loading.class.delay="opacity-50" wire:target="search">
                @forelse($materis as $materi)
                    @php
                        $iconSvg = '';
                        $iconClass = 'text-muted'; // Warna default
                        $fileType = $materi->file_type ?? '';

                        if (Str::startsWith($fileType, 'application/pdf')) {
                            $iconSvg = '<path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-1.5a1.5 1.5 0 0 0 0 3h1.5" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />';
                            $iconClass = 'text-danger';
                        } elseif (Str::startsWith($fileType, ['application/vnd.openxmlformats-officedocument.wordprocessingml', 'application/msword'])) {
                            $iconSvg = '<path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10.5 17h-1.5v-6h1.5" /><path d="M13.5 17h1.5v-6h-1.5" /><path d="M9 11h9" />';
                            $iconClass = 'text-primary';
                        } elseif (Str::startsWith($fileType, ['application/vnd.openxmlformats-officedocument.spreadsheetml', 'application/vnd.ms-excel'])) {
                            $iconSvg = '<path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M8 11h8v7h-8z" /><path d="M8 15h8" /><path d="M11 11v7" />';
                            $iconClass = 'text-success';
                        } elseif (Str::startsWith($fileType, 'image/')) {
                            $iconSvg = '<path d="M15 8h.01" /><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />';
                            $iconClass = 'text-info';
                        } elseif (Str::startsWith($fileType, 'video/')) {
                            $iconSvg = '<path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M8 4l0 16" /><path d="M16 4l0 16" /><path d="M4 8l4 0" /><path d="M4 16l4 0" /><path d="M4 12l16 0" /><path d="M16 8l4 0" /><path d="M16 16l4 0" />';
                            $iconClass = 'text-purple';
                        } elseif (Str::startsWith($fileType, ['application/zip', 'application/x-rar-compressed'])) {
                            $iconSvg = '<path d="M6 2h10a2 2 0 0 1 2 2v16a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-16a2 2 0 0 1 2 -2" /><path d="M11 7h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" /><path d="M10 7v9" />';
                            $iconClass = 'text-warning';
                        } else {
                            // Ikon file generik
                            $iconSvg = '<path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />';
                        }
                    @endphp

                    <div class="list-group-item" wire:key="{{ $materi->id }}">
                        <div class="row align-items-center g-3">

                            <div class="col-auto">
                                <span class="avatar avatar-lg bg-light-lt {{ $iconClass }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        {!! $iconSvg !!}
                                    </svg>
                                </span>
                            </div>

                            <div class="col">
                                <h4 class="m-0">{{ $materi->title }}</h4>
                                <p class="text-muted small m-0">
                                    Dibuat: {{ $materi->created_at->format('d M Y') }}
                                </p>
                                @if ($materi->description)
                                    <p class="text-muted m-0 mt-1 d-none d-sm-block">
                                        {{ Str::limit($materi->description, 150) }}
                                    </p>
                                @endif
                                @if ($materi->file_path)
                                    <div class="d-flex align-items-center mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm me-1 text-muted"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                        </svg>
                                        <small class="text-truncate"
                                            title="{{ $materi->file_name ?? basename($materi->file_path) }}">
                                            {{ $materi->file_name ?? basename($materi->file_path) }}
                                        </small>
                                    </div>
                                @endif
                            </div>

                            <div class="col-auto">
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    @if ($materi->file_path)
                                        <a href="{{ Storage::url($materi->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye me-1" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                            Preview
                                        </a>
                                        <a href="{{ Storage::url($materi->file_path) }}"
                                            download="{{ $materi->file_name ?? basename($materi->file_path) }}"
                                            class="btn btn-sm btn-outline-success">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-download me-1" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                <path d="M7 11l5 5l5 -5" />
                                                <path d="M12 4l0 12" />
                                            </svg>
                                            Download
                                        </a>
                                    @endif
                                    @if ($isAdmin)
                                        <button wire:click="deleteMateri({{ $materi->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus '{{ $materi->title }}'?"
                                            class="btn btn-sm btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash me-1" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                            Hapus
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item">
                        <div class="text-center py-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-off"
                                width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" style="opacity: 0.5;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 3l18 18" />
                                <path d="M7 3h7l5 5v7m0 4a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-14" />
                            </svg>
                            <h4 class="mt-3">Data Materi Kosong</h4>
                            <p class="text-muted">Belum ada materi yang ditambahkan untuk pelatihan ini.</p>
                            @if ($isAdmin)
                                <a href="{{ route('training.materi.create', $trainingId) }}"
                                    class="btn btn-primary" wire:navigate>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah Materi Pertama
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($materis->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        {{ $materis->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
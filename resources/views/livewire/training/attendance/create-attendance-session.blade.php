<div>
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Absensi', 'url' => route('admin.training.attendance.manage', $training->id)],
                    ['title' => 'Buat Sesi', 'url' => route('admin.training.attendance.create', $training->id)],
                ],
            ])

            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">Buat Sesi Absensi Baru</h2>
                            <p class="text-muted mb-0">Buat sesi absensi baru untuk pelatihan
                                <strong>{{ $training->name }}</strong>.</p>
                        </div>
                        <div class="col-auto ms-auto">
                            <a href="{{ route('admin.training.attendance.manage', $training) }}"
                                class="btn btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 6l-6 6l6 6" />
                                </svg>
                                Kembali ke Manajemen Absensi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form wire:submit="storeSession">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label required">Judul Sesi</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        wire:model="title" placeholder="Contoh: Hari 1 - Pembukaan">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Tanggal Sesi</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        wire:model="date">
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                        wire:model="start_time">
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                        wire:model="end_time">
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi (Opsional)</label>
                            <textarea class="form-control" wire:model="description" rows="3"
                                placeholder="Deskripsi singkat materi atau kegiatan..."></textarea>
                        </div>

                        <div class="form-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Buat Sesi Absensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

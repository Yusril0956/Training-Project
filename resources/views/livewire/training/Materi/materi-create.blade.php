<div class="page-body">
    <div class="container-xl">

        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => Str::limit($training->name, 20), 'url' => route('training.home', $training->id)],
                ['title' => 'Materi', 'url' => route('training.materi.index', $training->id)],
                ['title' => 'Tambah Baru', 'url' => null], // Halaman saat ini
            ],
        ])

        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title mb-1">
                        <i class="ti ti-plus me-1"></i>
                        Tambah Materi
                    </h2>
                    <p class="text-muted mb-0">
                        Tambahkan materi baru untuk pelatihan <strong>{{ $training->name }}</strong>.
                    </p>
                </div>
                <a href="{{ route('training.materi.index', $trainingId) }}" class="btn btn-outline-secondary"
                    wire:navigate>
                    <i class="ti ti-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form wire:submit.prevent="store">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Materi</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Judul Materi</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    wire:model="title" placeholder="Masukkan judul materi">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" wire:model="description"
                                    rows="4" placeholder="Masukkan deskripsi materi (opsional)"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">File Materi</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                    wire:model="file"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.gif,.mp4,.avi,.mov">
                                
                                <div wire:loading wire:target="file" class="text-muted small mt-2">
                                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    Mengunggah file...
                                </div>
                                
                                <small class="form-hint">Format yang didukung: PDF, DOC, PPT, XLS, Gambar, Video.
                                    Maksimal 10MB.</small>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if ($file && !$errors->has('file'))
                                <div class="mb-3">
                                    <label class="form-label">File Terpilih</label>
                                    <div class="alert alert-info py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-file-check me-2"></i>
                                            <div>
                                                <strong>{{ $file->getClientOriginalName() }}</strong>
                                                ({{ number_format($file->getSize() / 1024, 2) }} KB)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" 
                                wire:loading.attr="disabled" 
                                wire:target="store, file">
                                
                                <span wire:loading.remove wire:target="store">
                                    Simpan Materi
                                </span>
                                <span wire:loading wire:target="store">
                                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    Menyimpan...
                                </span>
                            </button>
                            <a href="{{ route('training.materi.index', $trainingId) }}"
                                class="btn btn-outline-secondary ms-2" wire:navigate>Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
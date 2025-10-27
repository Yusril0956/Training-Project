<div class="page-body">
    <div class="container-xl">
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                [
                    'title' => Str::limit($training->name, 20),
                    'url' => route('training.home', $training->id),
                ],
                ['title' => 'Materi', 'url' => route('training.materi.index', $training->id)],
                ['title' => 'Tambah Baru', 'url' => null],
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
                <a href="{{ route('training.materi.index', $training->id) }}" class="btn btn-outline-secondary"
                    wire:navigate>
                    <i class="ti ti-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </div>

        <form wire:submit="store" class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Materi</h3>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Judul Materi</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        wire:model.blur="title" placeholder="Masukkan judul materi">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" wire:model.blur="description" rows="4"
                        placeholder="Masukkan deskripsi materi (opsional)"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">File Materi</label>
                    
                    {{-- [PERUBAHAN] Hapus .live agar file di-submit bersama form --}}
                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                        wire:model="file"
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.gif,.mp4,.avi,.mov">
                    
                    {{-- [DIHAPUS] Loading state ini tidak diperlukan lagi --}}
                    {{-- <div wire:loading wire:target="file" ...> </div> --}}
                    
                    <small class="form-hint">
                        Format yang didukung: PDF, DOC, PPT, XLS, Gambar, Video. Maksimal 10MB.
                    </small>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- [DIHAPUS] Blok preview ini dihapus karena $file tidak lagi di-upload live --}}
                {{-- @if ($file && !$errors->has('file')) ... @endif --}}
                
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('training.materi.index', $training->id) }}" class="btn btn-outline-secondary me-2"
                    wire:navigate>
                    <i class="ti ti-x me-1"></i>Batal
                </a>
                
                {{-- [PERUBAHAN] wire:target hanya ke "store" --}}
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                    wire:target="store">
                    <span wire:loading.remove wire:target="store">
                        <i class="ti ti-device-floppy me-1"></i>Simpan Materi
                    </span>
                    <span wire:loading wire:target="store">
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>

    </div>
</div>
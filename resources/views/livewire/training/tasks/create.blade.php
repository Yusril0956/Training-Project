    <div class="page-body">
        <div class="container-xl">

            {{-- Breadcrumb --}}
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => Str::limit($training->name, 20), 'url' => route('training.home', $training->id)],
                    ['title' => 'Tugas', 'url' => route('training.tasks', $training->id)],
                    ['title' => 'Tambah', 'url' => '#'],
                ],
            ])

            <form wire:submit="save" enctype="multipart/form-data" class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">📝 Tambah Tugas Baru</h3>
                </div>

                <div class="card-body">
                    {{-- Nama Tugas --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text" wire:model="title" class="form-control"
                            placeholder="Contoh: Resume Materi Hari ke-2" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea wire:model="description" rows="4" class="form-control"
                            placeholder="Berikan instruksi atau penjelasan tugas..." required></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deadline --}}
                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="datetime-local" wire:model="deadline" class="form-control" required>
                        @error('deadline')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Lampiran --}}
                    <div class="mb-3">
                        <label class="form-label">Lampiran (Opsional)</label>
                        <input type="file" wire:model="attachment" class="form-control">
                        <small class="form-hint">PDF, DOCX, PPTX, atau gambar. Maks 5MB.</small>
                        @error('attachment')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('training.tasks', $training->id) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg> Simpan Tugas
                        </span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </div>

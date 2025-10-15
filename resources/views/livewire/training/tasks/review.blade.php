<div class="page-body">
    <div class="container-xl">

        {{-- Breadcrumb --}}
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => Str::limit($training->name, 20), 'url' => route('training.home', $training->id)],
                ['title' => 'Tugas', 'url' => route('training.tasks', $training->id)],
                ['title' => Str::limit($task->title, 20), 'url' => route('training.task.detail', [$training->id, $task->id])],
                ['title' => 'Penilaian', 'url' => '#'],
            ],
        ])

        {{-- Review Form --}}
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">📊 Penilaian Tugas</h3>
                <p class="text-muted mb-0">Nilai tugas dari <strong>{{ $submission->user->name }}</strong></p>
            </div>

            <form wire:submit="saveReview" class="card-body">
                {{-- Submission Details --}}
                <div class="mb-4">
                    <h5>Detail Pengumpulan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Peserta:</strong> {{ $submission->user->name }}</p>
                            <p><strong>Waktu Kirim:</strong> {{ $submission->submitted_at }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>File:</strong>
                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                    </svg> {{ basename($submission->file_path) }}
                                </a>
                            </p>
                            @if ($submission->answer)
                                <p><strong>Pesan:</strong> {{ $submission->answer }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>

                {{-- Review Form --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nilai (0-100)</label>
                            <input type="number" wire:model="score" class="form-control @error('score') is-invalid @enderror"
                                min="0" max="100" placeholder="Masukkan nilai" required>
                            @error('score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea wire:model="comment" rows="3" class="form-control @error('comment') is-invalid @enderror"
                                placeholder="Berikan komentar atau feedback..."></textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Existing Review --}}
                @if ($submission->review)
                    <div class="alert alert-info">
                        <h6>Penilaian Sebelumnya</h6>
                        <p><strong>Nilai:</strong> {{ $submission->review->score }}</p>
                        <p><strong>Komentar:</strong> {{ $submission->review->comment }}</p>
                        <p class="text-muted">Dinilai oleh: {{ $submission->review->reviewer->name }} pada
                            {{ $submission->review->created_at->format('d M Y H:i') }}</p>
                    </div>
                @endif

                <div class="card-footer text-end">
                    <a href="{{ route('training.task.detail', [$training->id, $task->id]) }}"
                        class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg> Simpan Penilaian
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
</div>

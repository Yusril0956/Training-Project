<div class="page-body">
    <div class="container-xl">

        {{-- Breadcrumb --}}
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => Str::limit($training->name, 20), 'url' => route('training.home', $training->id)],
                ['title' => 'Tugas', 'url' => route('training.tasks', $training->id)],
                ['title' => Str::limit($task->title, 20), 'url' => '#'],
            ],
        ])

        {{-- Detail Tugas --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-1">{{ $task->title }}</h2>
                <small class="text-muted">
                    Pelatihan: <strong>{{ $training->name }}</strong> |
                    Deadline:
                    <span class="badge {{ $task->deadline < now() ? 'bg-red-lt' : 'bg-green-lt' }}">
                        {{ $task->deadline->format('d M Y H:i') }}
                    </span>
                </small>
                <hr>
                <h5>Deskripsi</h5>
                <p class="text-muted">{{ $task->description }}</p>

                {{-- Lampiran --}}
                @if ($task->attachment_path)
                    <h5>Lampiran</h5>
                    <a href="{{ asset('storage/' . $task->attachment_path) }}" target="_blank"
                        class="btn btn-sm btn-outline-secondary mb-3">
                        📎 {{ basename($task->attachment_path) }}
                    </a>

                    @if (in_array(pathinfo($task->attachment_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $task->attachment_path) }}" alt="Lampiran"
                                class="img-fluid rounded">
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Untuk Admin --}}
        @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-3">Daftar Pengumpulan</h3>
                    @if ($submissions->isEmpty())
                        <p class="text-muted">Belum ada peserta yang mengumpulkan.</p>
                    @else
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Peserta</th>
                                    <th>File</th>
                                    <th>Waktu Kirim</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submissions as $submission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $submission->user->name }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">
                                                lihat
                                            </a>
                                        </td>
                                        <td>{{ $submission->submitted_at }}</td>
                                        <td>{{ $submission->review->score ?? 'Belum dinilai' }}</td>
                                        <td>
                                            <a href="{{ route('admin.submission.download', $submission->id) }}"
                                                class="btn btn-sm btn-primary">⬇️</a>
                                            <a href="{{ route('admin.task.review', [$training->id, $task->id, $submission->id]) }}"
                                                class="btn btn-sm btn-success">📝</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @else
            {{-- Untuk Peserta --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-3">Kumpulkan Tugas</h3>

                    {{-- Sudah mengumpulkan --}}
                    @if ($userSubmission)
                        <p class="text-success mb-2">✅ Kamu sudah mengumpulkan tugas ini.</p>
                        <a href="{{ asset('storage/' . $userSubmission->file_path) }}" target="_blank"
                            class="btn btn-sm btn-outline-secondary mb-3">
                            📎 Lihat Kiriman
                        </a>

                        {{-- Tombol Edit / Review --}}
                        @if ($task->deadline >= now() && !$userSubmission->review)
                            <button wire:click="toggleEditMode" class="btn btn-sm btn-info mb-3">
                                ✏️ Edit Kiriman
                            </button>
                        @elseif ($userSubmission->review)
                            <button wire:click="toggleReview" class="btn btn-sm btn-info mb-3">
                                📊 Lihat Penilaian
                            </button>
                        @elseif ($task->deadline < now())
                            <div class="alert alert-warning">⚠️ Tidak dapat mengedit tugas setelah deadline.</div>
                        @endif

                        {{-- Form Edit --}}
                        @if ($editMode)
                            <div class="border p-3 rounded mb-3">
                                <h5>Edit Kiriman</h5>
                                <form wire:submit.prevent="editTask" enctype="multipart/form-data">
                                    <div class="mb-2">
                                        <label class="form-label">File Baru (opsional)</label>
                                        <input type="file" wire:model="submission_file"
                                            class="form-control @error('submission_file') is-invalid @enderror">
                                        @error('submission_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Pesan</label>
                                        <input type="text" wire:model="message"
                                            class="form-control @error('message') is-invalid @enderror"
                                            placeholder="Pesan (opsional)">
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-info" wire:loading.attr="disabled">
                                        🔁 Update Kiriman
                                    </button>
                                </form>
                            </div>
                        @endif

                        {{-- Lihat Review --}}
                        @if ($showReview && $userSubmission->review)
                            <div class="border p-3 rounded mb-3">
                                <h5>📊 Penilaian Tugas</h5>
                                <p><strong>Nilai:</strong> {{ $userSubmission->review->score }}</p>
                                <p><strong>Komentar:</strong> {{ $userSubmission->review->comment }}</p>
                                <p class="text-muted">
                                    Dinilai oleh: {{ $userSubmission->review->reviewer->name }}
                                </p>
                            </div>
                        @endif
                    @else
                        {{-- Belum mengumpulkan --}}
                        <form wire:submit.prevent="submitTask" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">File Tugas</label>
                                <input type="file" wire:model="submission_file"
                                    class="form-control @error('submission_file') is-invalid @enderror" required>
                                @error('submission_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint">PDF, DOCX, PPTX, atau gambar (maks 5MB).</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pesan (Opsional)</label>
                                <input type="text" wire:model="message"
                                    class="form-control @error('message') is-invalid @enderror"
                                    placeholder="Tambahkan pesan jika diperlukan">
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                ✈️ Kirim Tugas
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

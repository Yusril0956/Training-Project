<div class="page-body">
    <div class="container-xl">
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => Str::limit($training->name, 20), 'url' => route('training.home', $training->id)],
                ['title' => 'Tugas', 'url' => route('training.tasks', $training->id)],
                ['title' => Str::limit($task->title, 20), 'url' => '#'],
            ],
        ])

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-1">{{ $task->title }}</h2>
                <small class="text-muted">
                    Pelatihan: <strong>{{ $training->name }}</strong> |
                    Deadline:
                    <span class="badge {{ $task->deadline->isPast() ? 'bg-red-lt' : 'bg-green-lt' }}">
                        {{ $task->deadline->format('d M Y H:i') }}
                        @if ($task->deadline->isPast())
                            (Terlewat)
                        @endif
                    </span>
                </small>
                <hr>
                <h5>Deskripsi</h5>
                <p class="text-muted">{{ $task->description }}</p>

                @if ($task->attachment_path)
                    <h5>Lampiran Tugas</h5>
                    <a href="{{ asset('storage/' . $task->attachment_path) }}" target="_blank"
                        class="btn btn-sm btn-outline-secondary mb-3">
                        Lampiran: {{ basename($task->attachment_path) }}
                    </a>

                    @if (in_array(strtolower(pathinfo($task->attachment_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $task->attachment_path) }}" alt="Lampiran tugas"
                                class="img-fluid rounded border" loading="lazy">
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                    <h3 class="card-title mb-0">Daftar Pengumpulan Peserta</h3>
                @else
                    <ul class="nav nav-tabs card-header-tabs nav-tabs-alt">
                        @if (!$userSubmission)
                            <li class="nav-item">
                                <button type="button"
                                    class="nav-link {{ $activeTab === 'submit' ? 'active' : '' }}"
                                    wire:click="setActiveTab('submit')">
                                    Kumpulkan Tugas
                                </button>
                            </li>
                        @endif

                        @if ($userSubmission)
                            <li class="nav-item">
                                <button type="button" class="nav-link {{ $activeTab === 'view' ? 'active' : '' }}"
                                    wire:click="setActiveTab('view')">
                                    Lihat Kiriman
                                </button>
                            </li>
                        @endif

                        @if ($userSubmission && $task->deadline->isFuture() && !$userSubmission->review)
                            <li class="nav-item">
                                <button type="button" class="nav-link {{ $activeTab === 'edit' ? 'active' : '' }}"
                                    wire:click="setActiveTab('edit')">
                                    Edit Kiriman
                                </button>
                            </li>
                        @endif

                        @if ($userSubmission && $userSubmission->review)
                            <li class="nav-item">
                                <button type="button"
                                    class="nav-link {{ $activeTab === 'review' ? 'active' : '' }}"
                                    wire:click="setActiveTab('review')">
                                    Lihat Penilaian
                                </button>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>

            <div class="card-body">
                @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                    @if ($submissions->isEmpty())
                        <p class="text-muted mb-0">Belum ada peserta yang mengumpulkan.</p>
                    @else
                        <div class="table-responsive">
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
                                                <a href="{{ asset('storage/' . $submission->file_path) }}"
                                                    target="_blank">
                                                    {{ Str::limit(basename($submission->file_path), 25) }}
                                                </a>
                                            </td>
                                            <td>{{ $submission->submitted_at->format('d M Y H:i') }}</td>
                                            <td>{{ $submission->review->score ?? 'Belum dinilai' }}</td>
                                            <td>
                                                <a href="{{ route('admin.task.review', [$training->id, $task->id, $submission->id]) }}"
                                                    class="btn btn-icon btn-sm btn-success" title="Nilai">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0 0z" fill="none" />
                                                        <path
                                                            d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path
                                                            d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @else
                    @if ($activeTab === 'submit' && !$userSubmission)
                        @if ($task->deadline->isPast())
                            <div class="alert alert-danger mb-0">
                                Deadline tugas telah terlewat. Anda tidak bisa mengirim tugas.
                            </div>
                        @else
                            <form wire:submit="submitTask" enctype="multipart/form-data">
                                <div class="mb-3" wire:key="submit-upload-{{ $submitUploadKey }}">
                                    <label class="form-label">File Tugas <span class="text-danger">*</span></label>
                                    <input type="file" wire:model="submission_file"
                                        class="form-control @error('submission_file') is-invalid @enderror" required>
                                    @error('submission_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-hint">PDF, DOCX, PPTX, atau gambar dengan ukuran maksimal
                                        5MB.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pesan</label>
                                    <input type="text" wire:model.blur="message"
                                        class="form-control @error('message') is-invalid @enderror"
                                        placeholder="Tambahkan pesan jika diperlukan">
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                        wire:target="submission_file,submitTask">
                                        Kirim Tugas
                                    </button>
                                    <div class="text-muted small" wire:loading wire:target="submission_file,submitTask">
                                        Mengunggah file, mohon tunggu...
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif

                    @if ($activeTab === 'view' && $userSubmission)
                        <div wire:key="tab-view-{{ $userSubmission->id }}">
                            <h3 class="card-title mb-3">Kiriman Anda</h3>

                            <p class="text-muted mb-1">
                                <strong>Dikirim pada:</strong>
                                {{ $userSubmission->submitted_at->format('d M Y H:i') }}
                            </p>
                            <p class="text-muted"><strong>Pesan:</strong> {{ $userSubmission->answer ?? '-' }}</p>

                            <a href="{{ asset('storage/' . $userSubmission->file_path) }}" target="_blank"
                                class="btn btn-sm btn-outline-secondary mb-3">
                                Lihat File: {{ basename($userSubmission->file_path) }}
                            </a>

                            @if ($fileIsImage)
                                <h5 class="mt-4">Pratinjau Gambar</h5>
                                <div class="mt-2 mb-4">
                                    <img src="{{ asset('storage/' . $userSubmission->file_path) }}"
                                        alt="Pratinjau kiriman" class="img-fluid rounded border"
                                        style="max-height: 400px; object-fit: contain;" loading="lazy">
                                </div>
                            @endif

                            @if ($task->deadline->isPast() && !$userSubmission->review)
                                <div class="alert alert-warning mb-0">
                                    Tugas sudah melewati deadline. Menunggu penilaian dari pengajar.
                                </div>
                            @elseif ($userSubmission->review)
                                <div class="alert alert-info mb-0">
                                    Tugas sudah dinilai. Silakan buka tab Lihat Penilaian.
                                </div>
                            @endif
                        </div>
                    @endif

                    @if ($activeTab === 'edit' && $userSubmission && $task->deadline->isFuture() && !$userSubmission->review)
                        <div wire:key="tab-edit-{{ $userSubmission->id }}">
                            <h3 class="card-title mb-3">Edit Kiriman</h3>

                            <form wire:submit="editTask" enctype="multipart/form-data">
                                <div class="alert alert-info">
                                    Anda dapat mengganti file dan/atau pesan. File saat ini:
                                    <strong>{{ basename($userSubmission->file_path) }}</strong>
                                </div>

                                <div class="mb-3" wire:key="edit-upload-{{ $editUploadKey }}">
                                    <label class="form-label">File Baru</label>
                                    <input type="file" wire:model="submission_file"
                                        class="form-control @error('submission_file') is-invalid @enderror">
                                    @error('submission_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pesan</label>
                                    <input type="text" wire:model.blur="message"
                                        class="form-control @error('message') is-invalid @enderror"
                                        placeholder="Pesan opsional">
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-info" wire:loading.attr="disabled"
                                        wire:target="submission_file,editTask">
                                        Update Kiriman
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        wire:click="setActiveTab('view')">
                                        Batal
                                    </button>
                                    <div class="text-muted small" wire:loading wire:target="submission_file,editTask">
                                        Mengunggah file, mohon tunggu...
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if ($activeTab === 'review' && $userSubmission && $userSubmission->review)
                        <div wire:key="tab-review-{{ $userSubmission->id }}">
                            <h3 class="card-title mb-3">Penilaian Tugas</h3>
                            <div class="card card-body bg-light-lt">
                                <p class="h4">
                                    Nilai:
                                    <span class="badge bg-green-lt text-green-lt-fg">
                                        {{ $userSubmission->review->score }}
                                    </span>
                                </p>
                                <p><strong>Komentar:</strong> {{ $userSubmission->review->comment ?? '-' }}</p>
                                <p class="text-muted small mb-0">
                                    Dinilai oleh: {{ $userSubmission->review->reviewer->name }} pada
                                    {{ $userSubmission->review->created_at->format('d M Y') }}
                                </p>
                            </div>

                            <button type="button" class="btn btn-outline-secondary mt-3"
                                wire:click="setActiveTab('view')">
                                Lihat Kiriman
                            </button>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

@extends('layouts.training')
@section('title', 'Detail Tugas')

@section('content')
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

            {{-- Task Detail Card --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex mb-3 align-items-center">
                        <i class="ti ti-clipboard-task fs-2 text-primary me-3"></i>
                        <div class="flex-fill">
                            <h2 class="card-title mb-1">{{ $task->title }}</h2>
                            <small class="text-muted">
                                Pelatihan: <strong>{{ $training->name }}</strong> |
                                Deadline:
                                <span class="badge {{ $task->deadline < now() ? 'badge bg-red-lt' : 'badge bg-green-lt' }}">
                                    {{ $task->deadline->format('d M Y H:i') }}
                                </span>
                            </small>
                        </div>
                    </div>

                    <hr>

                    {{-- Description --}}
                    <h5>Deskripsi</h5>
                    <p class="text-muted mb-4">{{ $task->description }}</p>

                    {{-- Attachment --}}
                    @if ($task->attachment_path)
                        <h5>Lampiran</h5>
                        <a href="{{ asset('storage/' . $task->attachment_path) }}" target="_blank"
                            class="btn btn-sm btn-outline-secondary mb-4">
                            <i class="ti ti-paperclip me-1"></i>
                            {{ basename($task->attachment_path) }}
                        </a>
                        {{-- Jika lampiran berupa gambar, tampilkan pratinjau --}}
                        @if (in_array(pathinfo($task->attachment_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $task->attachment_path) }}" alt="Lampiran Gambar"
                                    class="img-fluid rounded">
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            @if (Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                {{-- Submissions List (Admin) --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Daftar Pengumpulan</h3>
                        @if ($task->submissions->isEmpty())
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
                                    @foreach ($task->submissions as $submission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $submission->user->name }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">
                                                    {{ basename($submission->file_path) }}
                                                </a>
                                            </td>
                                            <td>{{ $submission->created_at->format('d M Y H:i') }}</td>
                                            <td>{{ $submission->review->score ?? 'belum dinilai' }}</td>
                                            <td>
                                                <a href="{{ route('admin.submission.download', $submission->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.task.review', [$training->id, $task->id, $submission->id]) }}"
                                                    class="btn btn-sm btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-check">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                        <path d="M15 19l2 2l4 -4" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- pagination jika perlu --}}
                            {{-- <div class="mt-3">
                                {{ $task->submissions->links() }}
                            </div> --}}
                        @endif
                    </div>
                </div>
            @else
                {{-- Submission Form (Peserta) --}}
                <div class="card shadow-sm mb-4">
                    <form action="{{ route('training.task.edit', [$training->id, $task->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h3 class="card-title mb-3">Kumpulkan Tugas</h3>
                            @php
                                $userSubmission = $task->submissions->where('user_id', auth()->id())->first();
                            @endphp

                            @if ($userSubmission && $userSubmission->file_path)
                                <p class="text-success">
                                    <i class="ti ti-check me-1"></i> Kamu sudah mengumpulkan tugas ini.
                                </p>
                                <a href="{{ asset('storage/' . $userSubmission->file_path) }}"
                                    class="btn btn-sm btn-outline-secondary mb-3" target="_blank">
                                    <i class="ti ti-paperclip me-1"></i> Lihat Kiriman
                                </a>

                                @if ($task->deadline >= now() && !$userSubmission->review)
                                    <button class="btn btn-sm btn-info mb-3" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#editForm-{{ $task->id }}" aria-expanded="false"
                                        aria-controls="editForm-{{ $task->id }}">
                                        <i class="ti ti-edit"></i> Edit Kiriman
                                    </button>
                                @elseif ($userSubmission->review)
                                    <button class="btn btn-sm btn-info mb-3" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#reviewForm-{{ $task->id }}" aria-expanded="false"
                                        aria-controls="reviewForm-{{ $task->id }}">
                                        <i class="ti ti-edit"></i> Lihat Penilaian
                                    </button>
                                @else
                                    @if ($task->deadline < now())
                                        <div class="alert alert-warning mb-3">
                                            <i class="ti ti-alert-triangle me-1"></i>
                                            Tidak dapat mengedit tugas karena deadline telah berlalu.
                                        </div>
                                    @endif
                                @endif

                                <div class="collapse" id="editForm-{{ $task->id }}">
                                    <form action="{{ route('training.task.edit', [$training->name, $task->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card border border-info mb-3">
                                            <div class="card-body">
                                                <h4 class="card-title mb-2">Form Edit</h4>
                                                <div class="mb-3">
                                                    <label class="form-label">Ganti File</label>
                                                    <input type="file" name="submission_file"
                                                        class="form-control @error('submission_file') is-invalid @enderror">
                                                    @error('submission_file')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                    <label class="form-label mt-2">Edit Pesan</label>
                                                    <input type="text" name="message"
                                                        class="form-control @error('message') is-invalid @enderror"
                                                        value="{{ old('message', $userSubmission->message) }}"
                                                        placeholder="Pesan (opsional)">
                                                    @error('message')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-info">
                                                    <i class="ti ti-refresh"></i> Update Kiriman
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="collapse" id="reviewForm-{{ $task->id }}">
                                    <div class="card border border-info mb-3">
                                        <div class="card-body">
                                            <h4 class="card-title mb-2">📊 Penilaian Tugas</h4>
                                            <div class="mb-3">
                                                <p><strong>Nilai:</strong> {{ $userSubmission->review->score }}</p>
                                                <p><strong>Komentar:</strong> {{ $userSubmission->review->comment }}</p>
                                                <p class="text-muted">Dinilai oleh:
                                                    {{ $userSubmission->review->reviewer->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Form Kirim Tugas Baru --}}
                                <div class="mb-3">
                                    <label class="form-label">Pilih File</label>
                                    <input type="file" name="submission_file"
                                        class="form-control @error('submission_file') is-invalid @enderror" required>
                                    @if (in_array(pathinfo($task->attachment_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <div class="mt-3">
                                            <img src="{{ asset('storage/' . $task->attachment_path) }}"
                                                alt="Lampiran Gambar" class="img-fluid rounded">
                                        </div>
                                    @endif
                                    @error('submission_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <label class="form-label mt-2">Pesan</label>
                                    <input type="text" name="message"
                                        class="form-control @error('message') is-invalid @enderror"
                                        value="{{ old('message') }}" placeholder="Pesan (opsional)">
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-upload me-1"></i> Kirim Tugas
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            @endif

            {{-- Back Button --}}
            <a href="{{ route('training.tasks', $training->id) }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Tugas
            </a>

        </div>
    </div>
@endsection

@extends('layouts.training')
@section('title', 'Detail Tugas')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <!-- Header Tugas -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{ $task->judul }}</h2>
                    <p class="text-muted">{{ $task->deskripsi }}</p>
                    <ul class="list-unstyled small">
                        <li><strong>Deadline:</strong> {{ $task->deadline->format('d M Y') }}</li>
                        <li><strong>Pelatihan:</strong> {{ $task->training->judul }}</li>
                    </ul>
                </div>
            </div>

            <!-- Form Pengumpulan Jawaban -->
            @if (Auth::check() && Auth::user()->hasRole(['User', 'Admin', 'Super Admin']))
                @php
                    $submission = $task->submissions->where('user_id', auth()->id())->first();
                @endphp

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">📝 Kirim Jawaban</h3>
                    </div>
                    <div class="card-body">
                        @if ($submission)
                            <p class="text-success">✅ Jawaban sudah dikirim pada
                                {{ $submission->submitted_at->format('d M Y H:i') }}</p>
                            <p><strong>Jawaban:</strong> {{ $submission->jawaban }}</p>
                            @if ($submission->file_path)
                                <p><strong>File:</strong> <a href="{{ Storage::url($submission->file_path) }}"
                                        target="_blank">Lihat File</a></p>
                            @endif
                        @else
                            <form action="{{ route('training.task.submit', [$task->training_id, $task->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Jawaban Teks</label>
                                    <textarea name="jawaban" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload File (Opsional)</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Daftar Pengumpulan (Admin View) -->
            @can('manage-training')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">📋 Jawaban Peserta</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Peserta</th>
                                    <th>Jawaban</th>
                                    <th>File</th>
                                    <th>Waktu Submit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($task->submissions as $submission)
                                    <tr>
                                        <td>{{ $submission->user->name }}</td>
                                        <td>{{ Str::limit($submission->jawaban, 50) }}</td>
                                        <td>
                                            @if ($submission->file_path)
                                                <a href="{{ Storage::url($submission->file_path) }}" target="_blank">Lihat
                                                    File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $submission->submitted_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada jawaban masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection

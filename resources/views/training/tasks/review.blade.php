@extends('layouts.training')
@section('title', 'Review Tugas')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => Str::limit($training->name, 20), 'url' => route('training.home', $training->id)],
                    ['title' => 'Tugas', 'url' => route('training.tasks', $training->id)],
                    ['title' => Str::limit($submission->task->title, 20), 'url' => '#'],
                ],
            ])

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">🧾 Penilaian Tugas</h3>
                </div>
                <form action="{{ route('admin.submission.review.store', ['submissionId' => $submission->id]) }}"
                    method="POST">
                    @csrf
                    <div class="card-body">
                        <p><strong>Peserta:</strong> {{ $submission->user->name }}</p>
                        <p><strong>Judul Tugas:</strong> {{ $submission->task->title }}</p>
                        <p><strong>File:</strong>
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">
                                {{ basename($submission->file_path) }}
                            </a>
                        </p>
                        @if (in_array(pathinfo($task->attachment_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $task->attachment_path) }}" alt="Lampiran Gambar"
                                    class="img-fluid rounded">
                            </div>
                        @endif
                        <p><strong>Pesan:</strong> {{ $submission->answer ?? 'Tidak ada pesan.' }}</p>

                        <div class="mb-3">
                            <label class="form-label">Nilai (0–100)</label>
                            <input type="number" name="score" class="form-control" min="0" max="100"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Komentar Instruktur</label>
                            <textarea name="comment" rows="4" class="form-control" placeholder="Berikan masukan atau evaluasi..."></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg> Simpan Penilaian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

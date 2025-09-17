<!-- {{-- resources/views/assignments/submissions.blade.php --}}
@extends('layouts.app') {{-- kalau kamu pakai layouts/admin ganti sesuai template utama --}}

@section('content')
<div class="container">
    <h1>Daftar Submissions untuk: {{ $assignment->title }}</h1>

    @if($assignment->submissions->isEmpty())
        <p>Belum ada yang submit tugas.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Peserta</th>
                    <th>Jawaban</th>
                    <th>File</th>
                    <th>Nilai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignment->submissions as $submission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $submission->user->name }}</td>
                        <td>{{ $submission->answer ?? '-' }}</td>
                        <td>
                            @if($submission->file)
                                <a href="{{ asset('storage/' . $submission->file) }}" target="_blank">Download</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $submission->score ?? 'Belum dinilai' }}</td>
                        <td>
                            <form method="POST" action="{{ route('assignments.grade', $submission->id) }}">
                                @csrf
                                <input type="number" name="score" min="0" max="100" value="{{ $submission->score }}">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection -->

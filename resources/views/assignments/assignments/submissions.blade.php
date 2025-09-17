{{-- resources/views/assignments/submissions.blade.php --}}
@extends('layouts.app') {{-- atau layouts.admin kalau kamu punya --}}

@section('content')
<div class="container">
    <h1>Submissions for: {{ $assignment->title }}</h1>

    @if($submissions->isEmpty())
        <p>No submissions yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Answer</th>
                    <th>File</th>
                    <th>Score</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $submission)
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
                        <td>{{ $submission->score ?? 'Not graded' }}</td>
                        <td>{{ $submission->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Assignment untuk {{ $training->title }}</h1>

    <a href="{{ route('assignments.create', $training->id) }}" class="btn btn-primary mb-3">+ Tambah Assignment</a>

    @if($assignments->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->title }}</td>
                        <td>{{ $assignment->description }}</td>
                        <td>{{ $assignment->deadline }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada assignment untuk training ini.</p>
    @endif
</div>
@endsection -->

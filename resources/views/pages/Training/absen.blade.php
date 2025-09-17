@extends('layouts.training')

@section('content')
<div class="container mt-4">
    <h2>Absen Peserta Training: {{ $training->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Training</th>
                <th>Status Absen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $index => $member)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $member->user->name }}</td>
                <td>{{ $member->user->email }}</td>
                <td>{{ $training->jenisTraining->name ?? '-' }}</td>
                <td>
                    @if($member->attendance->count() > 0)
                        Mengikuti Pelatihan Pada {{ $member->attendance->last()->attended_at->format('d-m-Y H:i') }}
                    @else
                        Belum Absen
                    @endif
                </td>
                <td>
                    @if($member->attendance->count() == 0)
                    <form action="{{ route('training.absen.mark', ['memberId' => $member->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Absen Sekarang</button>
                    </form>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>berhasil absen</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

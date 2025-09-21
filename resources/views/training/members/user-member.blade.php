@extends('layouts.training')
@section('title', 'Peserta Hadir')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            {{-- Breadcrumb --}}
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Members', 'url' => route('training.members', $training->id)],
                ],
            ])

            {{-- Header --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">👥 Peserta Hadir – {{ $training->name }}</h2>
                    <p class="text-muted">Berikut adalah daftar peserta yang telah hadir dalam pelatihan ini.</p>
                </div>
            </div>

            {{-- Tabel Peserta --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Instansi</th>
                                    <th>Email</th>
                                    <th>Waktu Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($training->members as $index => $member)
                                    {{-- @if ($member->is_present) --}}
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $member->user->name }}</td>
                                        <td>{{ $member->user->instansi ?? '-' }}</td>
                                        <td>{{ $member->user->email }}</td>
                                        {{-- <td>
                                                {{ $member->present_at ? \Carbon\Carbon::parse($member->present_at)->format('d M Y H:i') : '-' }}
                                            </td> --}}
                                    </tr>
                                    {{-- @endif --}}
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada peserta hadir.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@extends('layouts.training')
@section('title', 'Dashboard Training')

@section('content')

    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Customer Requested', 'url' => route('customer.requested')],
                    ['title' => $training->name, 'url' => route('cr.page', $training->id)],
                ],
            ])

            <!-- Header Training -->
            <div class="card mb-4">
                <div class="card-body text-center py-4">
                    <h2 class="card-title">{{ $training->name }}</h2>
                    <p class="text-muted">{{ $training->description ?? 'Deskripsi belum tersedia.' }}</p>
                    <span class="badge bg-primary">{{ ucfirst($training->category) }}</span>
                    <span class="badge bg-success">{{ ucfirst($training->status) }}</span>
                </div>
            </div>

            <!-- Info Kelas -->
            <div class="row row-cards mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">📅 Jadwal Pelatihan</h4>
                            <p><strong>Tanggal:</strong> {{ $schedule->date ?? 'belum ada jadwal' }}</p>
                            <p><strong>Durasi:</strong> -</p>
                            <p><strong>Lokasi:</strong> {{ $schedule->location ?? 'belum ada jadwal' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">👥 Informasi Training</h4>
                            <p><strong>PIC Internal:</strong> -</p>
                            <p><strong>Status:</strong> {{ ucfirst($training->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigasi Fitur -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">🔗 Navigasi Training</h3>
                </div>
                <div class="card-body">
                    <div class="row row-cards">
                        <div class="col-md-4">
                            <a href="{{ route('training.members', $training->id) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-green-lt text-green mb-2">👥</span>
                                    <div>Members</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('training.materials', $training->id) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-green-lt text-green mb-2">📚</span>
                                    <div>Materi & Modul</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('training.schedule', $training->id) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-yellow-lt text-yellow mb-2">🗓️</span>
                                    <div>Jadwal Pelatihan</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('training.tasks', $training->id) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-purple-lt text-purple mb-2">📝</span>
                                    <div>Tugas & Evaluasi</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('training.feedback', $training->id) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-cyan-lt text-cyan mb-2">💬</span>
                                    <div>Feedback Peserta</div>
                                </div>
                            </a>
                        </div>
                        @if (Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                            <div class="col-md-4">
                                <a href="{{ route('training.settings', $training->name) }}" class="card card-link">
                                    <div class="card-body text-center">
                                        <span class="avatar bg-red-lt text-red mb-2">⚙️</span>
                                        <div>Pengaturan Training</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Ringkasan Statistik (Opsional) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">📊 Ringkasan Aktivitas</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Total Peserta: {{ $training->members_count ?? '0' }}</li>
                        <li class="list-group-item">Materi Tersedia: {{ $training->materis_count ?? '0' }}</li>
                        <li class="list-group-item">Tugas Aktif: {{ $training->task_count ?? '0' }}</li>
                        <li class="list-group-item">Feedback Masuk: {{ $training->feedback_count ?? '0' }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection

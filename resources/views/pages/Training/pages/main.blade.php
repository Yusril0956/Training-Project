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
                            <p><strong>Tanggal:</strong> Belum dijadwalkan</p>
                            <p><strong>Durasi:</strong> -</p>
                            <p><strong>Lokasi:</strong> -</p>
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

            <!-- Self Registration Section -->
            @if(Auth::check())
                @php
                    $isMember = $training->members()->where('user_id', Auth::id())->exists();
                @endphp

                @if(!$isMember)
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">🚀 Daftar Training Ini</h4>
                            <p class="text-muted mb-3">Bergabunglah dengan training "{{ $training->name }}" untuk mendapatkan materi dan sertifikat</p>
                            <form action="{{ route('training.self.register', $training->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 5l0 14"/>
                                        <path d="M5 12l14 0"/>
                                    </svg>
                                    Daftar Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h4 class="card-title text-success">✅ Anda Sudah Terdaftar</h4>
                            <p class="text-muted">Selamat! Anda sudah terdaftar sebagai peserta training ini</p>
                            <a href="{{ route('training.members', $training->id) }}" class="btn btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/>
                                </svg>
                                Lihat Daftar Peserta
                            </a>
                        </div>
                    </div>
                @endif
            @endif

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

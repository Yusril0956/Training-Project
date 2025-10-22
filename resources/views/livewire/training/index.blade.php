<div class="page-body">
    <div class="container-xl">
        @include('partials._breadcrumb', [
            'items' => [
                ['title' => 'Training', 'url' => route('training.index')],
                ['title' => $training->name, 'url' => route('training.home', $training->id)],
            ],
        ])

        <!-- Header Training -->
        <div class="card mb-4">
            <div class="card-body text-center py-4">
                <h2 class="card-title">{{ $training->name }}</h2>
                <p class="text-muted">{{ $training->description ?? 'Deskripsi belum tersedia.' }}</p>
                <span class="badge bg-blue-lt">{{ ucfirst($training->category) }}</span>
                <span class="badge bg-green-lt">{{ ucfirst($training->status) }}</span>
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
                <h3 class="card-title">Navigasi Training</h3>
            </div>
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md-4">
                        <a href="{{ route('training.members.index', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-green-lt text-green mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg></span>
                                <div>Members</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('training.schedule', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-yellow-lt text-yellow mb-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M7 14h.013" />
                                        <path d="M10.01 14h.005" />
                                        <path d="M13.01 14h.005" />
                                        <path d="M16.015 14h.005" />
                                        <path d="M13.015 17h.005" />
                                        <path d="M7.01 17h.005" />
                                        <path d="M10.01 17h.005" />
                                    </svg></span>
                                <div>Jadwal Pelatihan</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('training.tasks', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-purple-lt text-purple mb-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-list">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 12l.01 0" />
                                        <path d="M13 12l2 0" />
                                        <path d="M9 16l.01 0" />
                                        <path d="M13 16l2 0" />
                                    </svg></span>
                                <div>Tugas</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('training.feedback', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-cyan-lt text-cyan mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-message-circle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 20l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235 -7.615 4.215 -11.574 2.293l-4.7 1" />
                                    </svg></span>
                                <div>Feedback Peserta</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('training.attendance', $training->id) }}" class="card card-link">
                            <div class="card-body text-center">
                                <span class="avatar bg-orange-lt text-orange mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M15 18l2 2l4 -4" />
                                    </svg></span>
                                <div>Absensi</div>
                            </div>
                        </a>
                    </div>
                    @if (Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                        <div class="col-md-4">
                            <a href="{{ route('training.settings', $training->id) }}" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-red-lt text-red mb-2"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        </svg></span>
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
                    <li class="list-group-item">Tugas Aktif: {{ $training->task_count ?? '0' }}</li>
                    <li class="list-group-item">Feedback Masuk: {{ $training->feedback_count ?? '0' }}</li>
                </ul>
            </div>
        </div>

    </div>
</div>

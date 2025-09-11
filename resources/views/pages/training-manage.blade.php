@extends('layouts.dashboard')
@section('title', 'Training Manage')

@section('content')

    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [['title' => 'Training Manage', 'url' => route('training.index')]],
            ])

            <!-- Header Training -->
            <div class="card mb-4">
                <div class="card-body text-center py-4">
                    <h2 class="card-title">Nikol</h2>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, molestiae!
                    </p>
                    <span class="badge bg-primary">lorem</span>
                    <span class="badge bg-success">Lorem.</span>
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
                            <p><strong>Status:</strong> pending</p>
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
                            <a href="#" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-green-lt text-green mb-2">👥</span>
                                    <div>Members</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-green-lt text-green mb-2">📚</span>
                                    <div>Materi & Modul</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-yellow-lt text-yellow mb-2">🗓️</span>
                                    <div>Jadwal Pelatihan</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-purple-lt text-purple mb-2">📝</span>
                                    <div>Tugas & Evaluasi</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="card card-link">
                                <div class="card-body text-center">
                                    <span class="avatar bg-cyan-lt text-cyan mb-2">💬</span>
                                    <div>Feedback Peserta</div>
                                </div>
                            </a>
                        </div>
                        @if (Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                            <div class="col-md-4">
                                <a href="#" class="card card-link">
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

            <div class="card mb-4">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><button class="table-sort" data-sort="sort-id">id</th>
                                    <th><button class="table-sort" data-sort="sort-name">Nama Training</button></th>
                                    <th><button class="table-sort" data-sort="sort-code">Code</button></th>
                                    <th><button class="table-sort" data-sort="sort-status">status</button></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @foreach ($trainings as $training)
                                    <tr>
                                        <td class="sort-id">{{ $training->id }}</td>
                                        <td class="sort-name">{{ $training->name }}</td>
                                        <td class="sort-code">{{ $training->jenisTraining->code }}</td>
                                        <td class="sort-status">{{ $training->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tbody>
                        <!-- Contoh data statis, ganti dengan loop Laravel -->
                        <tr>
                            <td>1</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit amet consectetur.</td>
                            <td>2025-08-27</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                            <td>2025-08-26</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Lorem, ipsum.</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing.</td>
                            <td>2025-08-25</td>
                        </tr>
                    </tbody> --}}
                        </table>
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


@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const list = new List('table-default', {
                sortClass: 'table-sort',
                listClass: 'table-tbody',
                valueNames: ['sort-id', 'sort-name', 'sort-code', 'sort-status',
                    {
                        attr: 'data-date',
                        name: 'sort-date'
                    },
                    {
                        attr: 'data-progress',
                        name: 'sort-progress'
                    },
                    'sort-quantity'
                ]
            });
        })
    </script>
@endpush
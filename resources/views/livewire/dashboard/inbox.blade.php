<div>
    <div>
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    {{-- Kolom kiri: breadcrumb --}}
                    <div class="col">
                        @include('partials._breadcrumb', [
                            'items' => [
                                ['url' => route('index'), 'title' => 'Dashboard'],
                                ['url' => '', 'title' => 'Inbox'],
                            ],
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Kotak Kritik & Saran</h3>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pengirim</th>
                                            <th>Pesan</th>
                                            <th>Tanggal Kirim</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($feedback as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_pengirim }}</td>
                                                <td>{{ $item->pesan }}</td>
                                                <td>{{ $item->tanggal_kirim ? \Carbon\Carbon::parse($item->tanggal_kirim)->format('d M Y H:i') : $item->created_at->format('d M Y H:i') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    Belum ada pesan feedback.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if ($feedback->hasPages())
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $feedback->withQueryString()->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

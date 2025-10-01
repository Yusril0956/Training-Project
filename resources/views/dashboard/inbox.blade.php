@extends('layouts.dashboard')
@section('title', 'Inbox')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">

                {{-- Kolom kiri: breadcrumb --}}
                <div class="col">
                    @include('partials._breadcrumb', [
                        'items' => [['title' => 'Inbox', 'url' => route('inbox')]],
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Kotak Kritik & Saran</h3>

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
                                    @foreach ($feedback as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_pengirim }}</td>
                                            <td>{{ $item->pesan }}</td>
                                            <td>{{ $item->tanggal_kirim }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination (opsional) -->
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
@endsection

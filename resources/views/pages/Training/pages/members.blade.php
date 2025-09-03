@extends('layouts.training')
@section('title', 'Members')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Customer Requested', 'url' => route('customer.requested')],
                    ['title' => $training->nama , 'url' => route('cr.page', $training->id)],
                    ['title' => 'Members', 'url' => route('training.members', $training->id)],
                ],
            ])
            <!-- Header -->
            <div class="card mb-3x">
                <div class="card-body">
                    <h2 class="card-title">👥 Daftar Peserta</h2>
                    <p class="text-muted">Berikut adalah peserta yang terdaftar dalam pelatihan
                        <strong>{{ $training->nama }}</strong>.
                    </p>
                </div>
            </div>

            <div class="row g-2 align-items-center">
                <div class="col-auto ms-auto">
                    <a href="{{ route('training.member.add.form', $training->id) }}" class="btn btn-primary">
                        <i class="ti ti-user-plus me-1"></i>
                        Add Member
                    </a>
                </div>
            </div>


            <!-- Tabel Peserta -->
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
                                    <th>Status Kehadiran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($training->members as $index => $member)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->instansi }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>
                                            @if ($member->hadir)
                                                <span class="badge bg-success">Hadir</span>
                                            @else
                                                <span class="badge bg-secondary">Belum Hadir</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                                            <form action="#" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($training->members->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada peserta terdaftar.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tambah Peserta -->
            @can('manage-training')
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">➕ Tambah Peserta</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('training.member.add', $training->id) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Peserta"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="instansi" class="form-control" placeholder="Instansi" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection

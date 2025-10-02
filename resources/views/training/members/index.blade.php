@extends('layouts.training')
@section('title', 'Members')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Members', 'url' => route('training.members', $training->id)],
                ],
            ])
            <!-- Header -->
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">👥 Daftar Peserta</h2>
                    <p class="text-muted">Berikut adalah peserta yang terdaftar dalam pelatihan
                        <strong>{{ $training->name }}</strong>.
                    </p>

                    <div class="col-auto ms-auto">
                        <a href="{{ route('training.member.add.form', $training->id) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                            </svg>
                            Add Member
                        </a>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                            </svg>
                            Add User + member
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabel Peserta -->
            <div class="card mb-3">
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
                                        <td>{{ $member->user->name }}</td>
                                        <td>{{ $member->user->instansi ?? 'N/A' }}</td>
                                        <td>{{ $member->user->email }}</td>
                                        <td>
                                            <span class="badge bg-secondary">Belum Hadir</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                                            <form
                                                action="{{ route('admin.training.member.delete', [$member->id, $training->id]) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirm('Anda yakin ingin menghapus member ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger btn-delete-user">Delete</button>
                                            </form>
                                            {{-- add graduation button --}}
                                            <a href="{{ route('admin.training.member.graduate', [$training->id, $member->id]) }}"
                                                class="btn btn-sm btn-success"
                                                onclick="return confirm('Yakin ingin menandai peserta ini sebagai lulus?')">Graduate</a>
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

            <!-- Header -->
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">👥 Daftar Peserta Graduated</h2>
                    <p class="text-muted">Berikut adalah peserta yang sudah lulus
                        <strong>{{ $training->name }}</strong>.
                    </p>
                </div>
            </div>

            <!-- Tabel Peserta -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Sertifikat</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($graduateMember as $index => $gMember)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $gMember->user->name }}</td>
                                        <td>
                                            <a href="{{ $gMember->user->certificates->first()?->file_path ? asset('storage/' . $gMember->user->certificates->first()->file_path) : '#' }}"
                                                class="btn {{ $gMember->user->certificates->first()?->file_path ? 'btn-primary' : 'btn-secondary' }} btn-sm">
                                                {{ $gMember->user->certificates->first()?->file_path ? 'Lihat' : 'N/A' }}
                                            </a>
                                        </td>
                                        <td>{{ $gMember->user->email }}</td>
                                    </tr>
                                @endforeach
                                @if ($graduateMember->isEmpty())
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

            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">👥 Daftar permintaan user</h2>
                    <p class="text-muted">Berikut adalah peserta yang terdaftar dalam pelatihan
                        <strong>{{ $training->name }}</strong>.
                    </p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingMembers as $index => $pMember)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pMember->user->name }}</td>
                                        <td>{{ $pMember->user->email }}</td>
                                        <td>
                                            <form
                                                action="{{ route('admin.training.member.accept', [$training->id, $pMember->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                            </form>
                                            <form
                                                action="{{ route('admin.training.member.reject', [$training->id, $pMember->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($pendingMembers->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada permintaan
                                            pendaftaran.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('training.member.add.user', $training->id) }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger alert-fixed-top-right">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" maxlength="6" class="form-control" name="nik"
                                placeholder="Masukkan NIK 6 digit">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="Masukkan alamat email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="add-status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto show configurable modal if session variables are present
        @if (session('modal_type'))
            const modal = new bootstrap.Modal(document.getElementById('modal-configurable'));
            modal.show();

            // Add event listener for the configurable modal button
            document.getElementById('btn-confirm-action').addEventListener('click', function() {
                // You can add custom action here based on modal type
                console.log('Modal action confirmed:', '{{ session('modal_type') }}');

                // If you need to perform different actions based on modal type:
                @if (session('modal_type') == 'success')
                    // Success action
                    console.log('Success action performed');
                @elseif (session('modal_type') == 'warning')
                    // Warning action  
                    console.log('Warning action performed');
                @elseif (session('modal_type') == 'info')
                    // Info action
                    console.log('Info action performed');
                @endif
            });
        @endif
        });
    </script>
@endpush

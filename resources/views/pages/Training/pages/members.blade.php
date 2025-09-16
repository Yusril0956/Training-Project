@extends('layouts.training')
@section('title', 'Members')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Customer Requested', 'url' => route('customer.requested')],
                    ['title' => $training->name, 'url' => route('cr.page', $training->id)],
                    ['title' => 'Members', 'url' => route('training.members', $training->id)],
                ],
            ])
            <!-- Header -->
            <div class="card mb-3x">
                <div class="card-body">
                    <h2 class="card-title">👥 Daftar Peserta</h2>
                    <p class="text-muted">Berikut adalah peserta yang terdaftar dalam pelatihan
                        <strong>{{ $training->name }}</strong>.
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
                                            <button type="submit" class="btn btn-sm btn-danger btn-delete-user"
                                                data-id="{{ $member->user->id }}" data-name="{{ $member->user->name }}"
                                                data-bs-toggle="modal" data-bs-target="#modal-danger">Delete</button>
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
                                            <form action="{{ route('training.member.accept', [$training->id, $pMember->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                            </form>
                                            <form action="{{ route('training.member.reject', [$training->id, $pMember->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($pendingMembers->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada permintaan pendaftaran.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                        <path d="M12 9v4" />
                        <path d="M12 17h.01" />
                    </svg>
                    <h3>Konfirmasi Hapus</h3>
                    <div class="text-secondary">Apakah Anda yakin ingin menghapus?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Batal
                                </a>
                            </div>
                            <div class="col">
                                <button id="btn-confirm-delete" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let deleteUserId = null;
            let deleteUserName = null;

            // Saat tombol delete diklik, simpan id user
            document.querySelectorAll('.btn-delete-user').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    deleteUserId = this.dataset.id;
                    deleteUserName = this.dataset.name;
                    // Ubah pesan modal jika mau
                    document.querySelector('#modal-danger h3').innerText = 'Hapus User?';
                    document.querySelector('#modal-danger .text-secondary').innerText =
                        'Yakin ingin menghapus user "' + deleteUserName + '"?';
                });
            });

            // Saat tombol konfirmasi di modal diklik, submit form delete via JS
            document.getElementById('btn-confirm-delete').onclick = function(e) {
                if (deleteUserId) {
                    // Buat form dinamis dan submit
                    let form = document.createElement('form');
                    form.action = '/admin/user/' + deleteUserId;
                    form.method = 'POST';

                    let csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    let method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            }

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

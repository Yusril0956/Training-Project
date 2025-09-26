@extends('layouts.dashboard')

@section('title', 'Admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                {{-- Kolom kiri: breadcrumb --}}
                <div class="col">
                    @include('partials._breadcrumb', [
                        'items' => [['title' => 'Admin', 'url' => route('admin.index')]],
                    ])
                </div>

                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title mb-1">👥 User Management</h2>
                            <p class="text-muted">Kelola pengguna sistem training.</p>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-create">
                                    <i class="ti ti-user-plus me-1"></i>
                                    Add User
                                </a>

                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" type="button"
                                        aria-expanded="false">
                                        More
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="ti ti-upload me-1"></i> Import Users
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.export.users', request()->query()) }}"
                                                target="_blank">
                                                <i class="ti ti-download me-1"></i> Export Users
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            {{-- Search and Actions --}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label for="search" class="form-label">Cari User</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-search"></i></span>
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="Cari berdasarkan nama atau email..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="role" class="form-label">Filter Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="">Semua Role</option>
                                <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>Super
                                    Admin</option>
                                <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ request('role') == 'User' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill" onclick="applyFilters()">
                                    <i class="ti ti-filter me-1"></i>Filter
                                </button>
                                <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary flex-fill">
                                    <i class="ti ti-x me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                    <th><button class="table-sort" data-sort="sort-email">Email</button></th>
                                    <th><button class="table-sort" data-sort="sort-role">Role</button></th>
                                    {{-- <th><button class="table-sort" data-sort="sort-status">Status</button></th>  --}}
                                    <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="sort-name">{{ $user->name }}</td>
                                        <td class="sort-email">{{ $user->email }}</td>
                                        <td class="sort-role">{{ $user->roles->pluck('name')->first() ?? 'User' }}</td>
                                        {{-- <td class="sort-status">{{ $user->status }}</td> --}}
                                        <td class="sort-date" data-date="{{ $user->created_at }}">
                                            {{ $user->created_at->format('F d, Y') }}</td>
                                        <td class="sort-action">
                                            @if (Auth::id() !== $user->id && !$user->hasRole('Super Admin'))
                                                {{-- Tidak bisa edit/hapus diri sendiri atau super_admin --}}
                                                <a href="#" class="btn btn-sm btn-primary btn-edit-user"
                                                    data-bs-toggle="modal" data-bs-target="#modal-edit"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-role="{{ $user->roles->pluck('name')->first() ?? 'User' }}"
                                                    data-status="active">
                                                    Edit
                                                </a>
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete-user"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-bs-toggle="modal" data-bs-target="#modal-danger">Delete</button>
                                            @else
                                                <span class="text-muted">No action available</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                @if ($users->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $users->withQueryString()->links() }}
                    </div>
                @endif
            </div>

            <!-- Keep the original danger modal for backward compatibility -->
            <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-danger"></div>
                        <div class="modal-body text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                        <button id="btn-confirm-delete" class="btn btn-danger w-100"
                                            data-bs-dismiss="modal">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit User (hanya satu, tidak dobel) -->
            <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
                <form id="form-edit-user" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">User Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="edit-name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="edit-email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select" name="role" id="edit-role">
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status" id="edit-status">
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
                                    Edit User
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Add User (tidak diubah) -->
            <div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
                <form action="{{ route('admin.user.add') }}" method="POST">
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NIK</label>
                                    <input type="text" maxlength="6" class="form-control" name="nik"
                                        placeholder="Masukkan NIK 16 digit">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Masukkan alamat email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select" name="role" id="add-role">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                        <option value="staff">Staff</option>
                                    </select>
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
                                    Add User
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @include('components.modal')
        </div>
    </div>
@endsection

@push('script')
    <script>
        function applyFilters() {
            const search = document.getElementById('search').value;
            const role = document.getElementById('role').value;

            let url = '{{ route('admin.index') }}';
            const params = new URLSearchParams();

            if (search) params.append('search', search);
            if (role) params.append('role', role);

            if (params.toString()) {
                url += '?' + params.toString();
            }

            window.location.href = url;
        }

        // Allow search on Enter key
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const list = new List('table-default', {
                sortClass: 'table-sort',
                listClass: 'table-tbody',
                valueNames: ['sort-name', 'sort-email', 'sort-role', 'sort-date',
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-edit-user').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    // Isi value input modal
                    document.getElementById('edit-name').value = this.dataset.name;
                    document.getElementById('edit-email').value = this.dataset.email;
                    document.getElementById('edit-role').value = this.dataset.role;
                    document.getElementById('edit-status').value = this.dataset.status;
                    // Set action form
                    document.getElementById('form-edit-user').action = '/useredit/' + this.dataset
                        .id;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto dismiss alert after 4 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert-fixed-top-right').forEach(function(alert) {
                    if (alert) alert.classList.add('fade');
                    setTimeout(function() {
                        if (alert) alert.remove();
                    }, 500); // waktu fade out
                });
            }, 4000);

            // Dismiss alert on scroll
            let alertDismissed = false;
            window.addEventListener('scroll', function() {
                if (!alertDismissed) {
                    document.querySelectorAll('.alert-fixed-top-right').forEach(function(alert) {
                        if (alert) alert.classList.add('fade');
                        setTimeout(function() {
                            if (alert) alert.remove();
                        }, 500);
                    });
                    alertDismissed = true;
                }
            });
        });
    </script>
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

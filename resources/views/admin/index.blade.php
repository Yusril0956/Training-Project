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
            </div>
        </div>
    </div>


    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            <livewire:dashboard.user-search />

            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1">Certificates Management</h2>
                        <p class="text-muted">Lihat daftar sertifikat user</p>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('admin.certificate.create') }}" class="btn btn-primary">
                                Add Certificate
                            </a>
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
                                    <th><button class="table-sort" data-sort="sort-name">No</button></th>
                                    <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                    <th><button class="table-sort" data-sort="sort-email">Kegiatan</button></th>
                                    <th><button class="table-sort" data-sort="sort-status">Status</button></th>
                                    <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                                    <th><button class="table-sort" data-sort="sort-status">File</button></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @forelse ($certificates as $certificate)
                                    <tr>
                                        <td class="sort-name">{{ $certificate->user_id }}</td>
                                        <td class="sort-name">{{ $certificate->participant_name }}</td>
                                        <td class="sort-email">{{ $certificate->activity_name }}</td>
                                        <td class="sort-role">{{ $certificate->status }}</td>
                                        <td class="sort-date">{{ $certificate->activity_date }}</td>
                                        <td class="sort-date"><a href="{{ asset('storage/' . $certificate->file_path) }}"
                                                target="_blank">
                                                {{ basename($certificate->file_path, 5) }}
                                            </a></td>
                                        <td class="sort-action">
                                            <form action="{{ route('admin.certificate.accept', $certificate->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                            </form>
                                            <form action="{{ route('admin.certificate.reject', $certificate->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="colspan-6">
                                            <div class="alert alert-warning text-center">
                                                Belum ada user yang request.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($certificates->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $certificates->withQueryString()->links() }}
                    </div>
                @endif
            </div>
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

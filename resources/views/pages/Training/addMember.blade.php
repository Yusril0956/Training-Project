@extends('layouts.training')
@section('title', 'Tambah Peserta')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Form untuk submit -->
            <form action="{{ route('training.member.add', $training->id) }}" method="POST" id="add-members-form">
                @csrf

                <label class="form-label">Pilih Peserta</label>
                <p class="text-muted small">Centang satu atau lebih peserta yang akan ditambahkan ke pelatihan ini</p>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-1">
                                    <div class="form-check">
                                        <input id="select-all" class="form-check-input" type="checkbox" />
                                    </div>
                                </th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input user-checkbox" name="user_ids[]" type="checkbox"
                                                value="{{ $user->id }}" />
                                        </div>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-text">
                    Klik <strong>Select All</strong> untuk memilih semua peserta sekaligus.
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <small>Pilih minimal 1 peserta untuk melanjutkan</small>
                    </div>
                    <div class="btn-list">
                        <a href="{{ route('training.members', $training->id) }}" class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l14 0"/>
                                <path d="M5 12l6 6"/>
                                <path d="M5 12l6 -6"/>
                            </svg>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary" id="btn-add-members" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            Tambah Peserta
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle semua checkbox peserta
        document.getElementById('select-all')
            .addEventListener('change', function() {
                document.querySelectorAll('.user-checkbox').forEach(cb => {
                    cb.checked = this.checked;
                });
                toggleAddButton();
            });

        // Toggle tombol tambah peserta berdasarkan checkbox yang dipilih
        function toggleAddButton() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            const addButton = document.getElementById('btn-add-members');
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            addButton.disabled = !anyChecked;
        }

        // Tambahkan event listener ke setiap checkbox user
        document.querySelectorAll('.user-checkbox').forEach(cb => {
            cb.addEventListener('change', toggleAddButton);
        });

        // Inisialisasi tombol saat halaman dimuat
        toggleAddButton();
    </script>
@endpush

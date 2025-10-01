@extends('layouts.dashboard')

@section('title', 'Profile')

@push('avatar')
    <script>
        function previewAvatar(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush

@push('styles')
    <style>
        /* Modal square auto-fit konten */
        .modal-square .modal-dialog {
            display: inline-block;
            max-width: none;
        }

        .modal-square .modal-content {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 10px;
        }

        .modal-square .modal-body {
            padding: 0;
            display: inline-block;
        }

        /* Dropzone styling */
        .dropzone {
            width: 200px;
            aspect-ratio: 1 / 1;
            border: 2px dashed var(--tblr-border-color);
            border-radius: 6px;
            background: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dropzone .dz-message {
            text-align: center;
            margin: 0;
            background: none !important;
        }

        .dropzone .dz-preview {
            margin: 4px;
        }

        /* Center modal content */
        #modal-avatar .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 250px;
        }
    </style>
@endpush

@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            {{-- @include('components.alert') --}}

            <div class="card">
                <div class="row g-0">
                    <div class="card-body">
                        <h2 class="mb-4">Akun Saya</h2>
                        <h3 class="card-title">Detail Profil</h3>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar avatar-xl"
                                    style="background-image: url({{ $user->avatar_url ? asset($user->avatar_url) . '?t=' . time() : asset('images/default_avatar.png') }})"></span>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-avatar">Ganti
                                    Profile</a>
                            </div>
                            <div class="col-auto">
                                <!-- DELETE AVATAR FORM -->
                                <form action="{{ route('user.deleteAvatar') }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus avatar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost-danger">Hapus Profile</button>
                                </form>
                            </div>
                        </div>

                        <h3 class="card-title mt-4">Profile
                            <a href="#" class="btn btn-sm btn-primary ms-2" data-bs-toggle="modal"
                                data-bs-target="#modal-edit-profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg> Edit
                            </a>
                        </h3>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label">Username</div>
                                <div class="form-control-plaintext">{{ $user->name }}</div>
                            </div>
                            <div class="col-md">
                                <div class="form-label">Email</div>
                                <div class="form-control-plaintext">{{ $user->email }}</div>
                            </div>
                            <div class="col-md">
                                <div class="form-label">NIK</div>
                                <div class="form-control-plaintext">{{ $user->nik }}</div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md">
                                <div class="form-label">Role</div>
                                <div class="form-control-plaintext">{{ $user->roles->pluck('name')->join(', ') }}</div>
                            </div>
                            <div class="col-md">
                                <div class="form-label">Status</div>
                                <div class="form-control-plaintext">{{ $user->status }}</div>
                            </div>
                        </div>

                        <h3 class="card-title mt-4">Password</h3>
                        <p class="card-subtitle">Anda dapat mengatur kata sandi permanen jika tidak ingin menggunakan kode
                            login sementara.</p>
                        <div>
                            <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-new-password">Set
                                new password</a>
                        </div>

                        <h3 class="card-title mt-4">Public profile</h3>
                        <p class="card-subtitle">Menjadikan profil Anda publik berarti siapa pun di jaringan Dashkit akan
                            dapat menemukan Anda.</p>
                        <div>
                            <label class="form-check form-switch form-switch-lg">
                                <input class="form-check-input" type="checkbox"
                                    {{ $user->status == 'active' ? 'checked' : '' }}>
                                <span class="form-check-label form-check-label-on">Anda saat ini terlihat</span>
                                <span class="form-check-label form-check-label-off">Anda saat ini tidak terlihat</span>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <a href="#" class="btn">Batal</a>
                            <a href="#" class="btn btn-primary">Kirim</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal new password -->
    <div class="modal modal-blur fade" id="modal-new-password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="{{ route('setting.password') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Kata Sandi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Password baru</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password baru</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal avatar (Dropzone) -->
    <div class="modal modal-blur fade" id="modal-avatar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" id="avatar-form" method="POST" action="{{ route('setting.avatar') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropzone -->
                    <div class="dropzone dz-clickable" id="dropzone-upload">
                        <div class="dz-message">
                            <h3 class="dropzone-msg-title">Drag & drop gambar di sini</h3>
                            <span class="dropzone-msg-desc">atau klik untuk memilih file</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link" data-bs-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal edit profile -->
    <div class="modal modal-blur fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="{{ route('setting.profile') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="name" id="edit-profile-name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="edit-profile-email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" name="nik" id="edit-profile-nik" maxlength="6"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.css" rel="stylesheet" />

    <script>
        Dropzone.autoDiscover = false;

        document.addEventListener("DOMContentLoaded", function() {
            // Populate profile edit modal with current values
            const editProfileModal = document.getElementById('modal-edit-profile');
            if (editProfileModal) {
                editProfileModal.addEventListener('show.bs.modal', function() {
                    document.getElementById('edit-profile-name').value = '{{ $user->name }}';
                    document.getElementById('edit-profile-email').value = '{{ $user->email }}';
                    document.getElementById('edit-profile-nik').value = '{{ $user->nik ?? '' }}';
                });
            }

            // Dropzone init
            var dz = new Dropzone("#dropzone-upload", {
                url: "{{ route('setting.avatar') }}",
                paramName: "avatar",
                maxFiles: 1,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictRemoveFile: "Hapus",
                autoProcessQueue: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                init: function() {
                    let myDropzone = this;
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });

                    // submit form manually
                    document.querySelector("#avatar-form").addEventListener("submit", function(e) {
                        e.preventDefault();
                        if (myDropzone.getQueuedFiles().length > 0) {
                            myDropzone.processQueue();
                        } else {
                            e.target.submit();
                        }
                    });

                    // success callback
                    this.on("success", function(file, response) {
                        location.reload();
                    });
                }
            });
        });
    </script>
@endpush

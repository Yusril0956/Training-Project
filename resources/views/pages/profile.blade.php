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

@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
        @include('components._alert')

            <div class="card">
                <div class="row g-0">
                    <div class="card-body">
                        <h2 class="mb-4">My Account</h2>
                        <h3 class="card-title">Profile Details</h3>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar avatar-xl"
                                    style="background-image: url({{ $user->profile ? asset($user->profile) . '?t=' . time() : asset('images/default_avatar.png') }})"></span>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-image">Change
                                    avatar</a>
                            </div>
                            <div class="col-auto">
                                <!-- DELETE AVATAR FORM -->
                                <form action="{{ route('user.deleteAvatar') }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus avatar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost-danger">Delete avatar</button>
                                </form>
                            </div>
                        </div>

                        <h3 class="card-title mt-4">Profile
                            <a href="#" class="btn btn-sm btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#modal-edit-profile">
                                <i class="ti ti-edit me-1"></i>Edit
                            </a>
                        </h3>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label">Name</div>
                                <div class="form-control-plaintext">{{ $user->name }}</div>
                            </div>
                            <div class="col-md">
                                <div class="form-label">Email</div>
                                <div class="form-control-plaintext">{{ $user->email }}</div>
                            </div>
                            <div class="col-md">
                                <div class="form-label">Telepon</div>
                                <div class="form-control-plaintext">{{ $user->phone }}</div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md">
                                <div class="form-label">Alamat</div>
                                <div class="form-control-plaintext">{{ $user->address }}</div>
                            </div>
                            <div class="col-md">
                                <div class="form-label">Role</div>
                                <div class="form-control-plaintext">{{ $user->role }}</div>
                            </div>
                            <div class="col-md">
                                <div class="form-label">Status</div>
                                <div class="form-control-plaintext">{{ $user->status }}</div>
                            </div>
                        </div>

                        <h3 class="card-title mt-4">Password</h3>
                        <p class="card-subtitle">You can set a permanent password if you don't want to use temporary
                            login codes.</p>
                        <div>
                            <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-new-password">Set
                                new password</a>
                        </div>

                        <h3 class="card-title mt-4">Public profile</h3>
                        <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network
                            will be able to find you.</p>
                        <div>
                            <label class="form-check form-switch form-switch-lg">
                                <input class="form-check-input" type="checkbox"
                                    {{ $user->status == 'active' ? 'checked' : '' }}>
                                <span class="form-check-label form-check-label-on">You're currently visible</span>
                                <span class="form-check-label form-check-label-off">You're currently invisible</span>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <a href="#" class="btn">Cancel</a>
                            <a href="#" class="btn btn-primary">Submit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal avatar -->
    <div class="modal modal-blur fade" id="modal-image" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="{{ route('setting.avatar') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <img id="avatar-preview"
                            src="{{ $user->profile ? asset($user->profile) . '?t=' . time() : asset('images/default_avatar.png') }}"
                            class="avatar avatar-xl mb-2" style="object-fit:cover;" alt="Avatar Preview">
                        <input type="file" class="form-control mt-2" name="avatar" accept="image/*"
                            onchange="previewAvatar(event)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal new password -->
    <div class="modal modal-blur fade" id="modal-new-password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="{{ route('setting.password') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Set New Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="edit-profile-name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="edit-profile-email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="phone" id="edit-profile-phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="address" id="edit-profile-address" rows="3"></textarea>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto show configurable modal if session variables are present
            @if (session('modal_type'))
                const modal = new bootstrap.Modal(document.getElementById('modal-configurable'));
                modal.show();

                // Add event listener for the configurable modal button
                document.getElementById('btn-confirm-action').addEventListener('click', function() {
                    console.log('Modal action confirmed:', '{{ session('modal_type') }}');
                });
            @endif

            // Populate profile edit modal with current values
            const editProfileModal = document.getElementById('modal-edit-profile');
            if (editProfileModal) {
                editProfileModal.addEventListener('show.bs.modal', function() {
                    document.getElementById('edit-profile-name').value = '{{ $user->name }}';
                    document.getElementById('edit-profile-email').value = '{{ $user->email }}';
                    document.getElementById('edit-profile-phone').value = '{{ $user->phone ?? '' }}';
                    document.getElementById('edit-profile-address').value = '{{ $user->address ?? '' }}';
                });
            }
        });
    </script>
@endpush

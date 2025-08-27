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
        if(input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
@endpush

@section('content')
  <div class="page-wrapper">
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="row g-0">
            <div class="col-12 col-md-9 d-flex flex-column">
              <div class="card-body">
                <h2 class="mb-4">My Account</h2>
                <h3 class="card-title">Profile Details</h3>
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="avatar avatar-xl" style="background-image: url({{ $user->profile ?? asset('images/default_avatar.png') }})"></span>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-image">Change avatar</a>
                  </div>
                  <div class="col-auto">
                    <!-- DELETE AVATAR FORM -->
                    <form action="{{ route('user.deleteAvatar') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus avatar?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-ghost-danger">Delete avatar</button>
                    </form>
                  </div>
                </div>

                <h3 class="card-title mt-4">Profile</h3>
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
                <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                <div>
                  <a href="#" class="btn">Set new password</a>
                </div>

                <h3 class="card-title mt-4">Public profile</h3>
                <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network will be able to find you.</p>
                <div>
                  <label class="form-check form-switch form-switch-lg">
                    <input class="form-check-input" type="checkbox" {{ $user->status == 'active' ? 'checked' : '' }}>
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
    </div>
    @include('partials._footer')
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
            <img id="avatar-preview" src="{{ $user->profile ? asset($user->profile) : asset('images/default_avatar.png') }}" class="avatar avatar-xl mb-2" style="object-fit:cover;" alt="Avatar Preview">
            <input type="file" class="form-control mt-2" name="avatar" accept="image/*" onchange="previewAvatar(event)">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('script')
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      // Auto show configurable modal if session variables are present
      @if(session('modal_type'))
          const modal = new bootstrap.Modal(document.getElementById('modal-configurable'));
          modal.show();
          
          // Add event listener for the configurable modal button
          document.getElementById('btn-confirm-action').addEventListener('click', function() {
              console.log('Modal action confirmed:', '{{ session('modal_type') }}');
          });
      @endif
  });
  </script>
@endpush
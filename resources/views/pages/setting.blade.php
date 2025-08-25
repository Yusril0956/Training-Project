<!doctype html> 
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Settings - Tabler Dashboard</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body>
    <script src="./dist/js/demo-theme.min.js"></script>
    <div class="page">
      <!-- Navbar -->
        @include('partials._navbar')
      <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="row g-0">
                <div class="col-12 col-md-3 border-end">
                  <div class="card-body">
                    <h4 class="subheader">Settings</h4>
                    <div class="list-group list-group-transparent">
                      <a href="./settings.html" class="list-group-item list-group-item-action d-flex align-items-center active">My Account</a>
                      <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">My Notifications</a>
                      <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Connected Apps</a>
                      <a href="./settings-plan.html" class="list-group-item list-group-item-action d-flex align-items-center">Plans</a>
                      <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Billing & Invoices</a>
                    </div>
                    <h4 class="subheader mt-4">Experience</h4>
                    <div class="list-group list-group-transparent">
                      <a href="#" class="list-group-item list-group-item-action">Give Feedback</a>
                    </div>
                  </div>
                </div>
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

        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank" class="link-secondary">Documentation</a></li>
                  <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
                  <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary">Source code</a></li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2023
                    <a href="." class="link-secondary">Tabler</a>.
                    All rights reserved.
                  </li>
                  <li class="list-inline-item">
                    <a href="./changelog.html" class="link-secondary">v1.0.0-beta20</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>

      <!-- Modal avatar -->
      <div class="modal modal-blur fade" id="modal-image" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Profile Picture</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3 align-items-end">
                <a href="#" class="avatar avatar-upload rounded" width="100" height="100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="100" height="100" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  <span class="avatar-upload-text">drop or add</span>
                </a>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Add Team</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabler JS -->
    <script src="./dist/js/tabler.min.js" defer></script>
    <script src="./dist/js/demo.min.js" defer></script>
  </body>
</html>

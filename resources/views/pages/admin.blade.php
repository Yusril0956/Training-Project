<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin - {{config('app.name')}}</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1692870487" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      .alert-fixed-top-right {
        position: fixed;
        top: 24px;
        right: 24px;
        min-width: 300px;
        margin-top: 33px;
        background: #fff !important;
        z-index: 1055; /* lebih tinggi dari modal backdrop */
        box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        transition: opacity 0.5s ease-in-out;
        opacity: 1;
      }
      .alert-fixed-top-right.fade {
        opacity: 0;
      }
    </style>
  </head>
  <body >
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

        @include('partials._navbar')

        <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Datatables
                </h2>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                  Add User</a>               
              </div>
            </div>
          </div>
        </div>

        @include('partials._alert')

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
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
                            <td class="sort-role">{{ $user->role }}</td>
                            {{-- <td class="sort-status">{{ $user->status }}</td> --}}
                            <td class="sort-date" data-date="{{ $user->created_at }}">{{ $user->created_at->format('F d, Y') }}</td>
                            <td class="sort-action">
                              <a href="#" 
                                 class="btn btn-sm btn-primary btn-edit-user" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#modal-edit"
                                 data-id="{{ $user->id }}"
                                 data-name="{{ $user->name }}"
                                 data-email="{{ $user->email }}"
                                 data-role="{{ $user->role }}"
                                 data-status="{{ $user->status }}">
                                 Edit
                              </a>
                              <button type="submit" class="btn btn-sm btn-danger btn-delete-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-bs-toggle="modal" data-bs-target="#modal-danger">Delete</button>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
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
                  <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank" class="link-secondary" rel="noopener">Documentation</a></li>
                  <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
                  <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
                  <li class="list-inline-item">
                    <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                      <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Sponsor
                    </a>
                  </li>
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
                    <a href="./changelog.html" class="link-secondary" rel="noopener">
                      v1.0.0-beta20
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
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
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                      <option value="admin">Admin</option>
                      <option value="user">User</option>
                      <option value="staff">Staff</option>
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
        <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
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
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" maxlength="16" class="form-control" name="nik">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" maxlength="16" class="form-control" name="phone">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="address">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <input type="text" class="form-control" name="city">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Your report name">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Your report name">
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

        @include('partials._modal')

    </div>
    <!-- Libs JS -->
    <script src="./dist/libs/list.js/dist/list.min.js?1692870487" defer></script>
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1692870487" defer></script>
    <script src="./dist/js/demo.min.js?1692870487" defer></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
      const list = new List('table-default', {
          sortClass: 'table-sort',
          listClass: 'table-tbody',
          valueNames: [ 'sort-name', 'sort-email', 'sort-role', 'sort-date', 
              { attr: 'data-date', name: 'sort-date' },
              { attr: 'data-progress', name: 'sort-progress' },
              'sort-quantity'
          ]
      });
      })
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-edit-user').forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Isi value input modal
                document.getElementById('edit-name').value = this.dataset.name;
                document.getElementById('edit-email').value = this.dataset.email;
                document.getElementById('edit-role').value = this.dataset.role;
                document.getElementById('edit-status').value = this.dataset.status;
                // Set action form
                document.getElementById('form-edit-user').action = '/useredit/' + this.dataset.id;
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Auto dismiss alert after 4 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert-fixed-top-right').forEach(function(alert) {
                if(alert) alert.classList.add('fade');
                setTimeout(function() {
                    if(alert) alert.remove();
                }, 500); // waktu fade out
            });
        }, 4000);

        // Dismiss alert on scroll
        let alertDismissed = false;
        window.addEventListener('scroll', function() {
            if (!alertDismissed) {
                document.querySelectorAll('.alert-fixed-top-right').forEach(function(alert) {
                    if(alert) alert.classList.add('fade');
                    setTimeout(function() {
                        if(alert) alert.remove();
                    }, 500);
                });
                alertDismissed = true;
            }
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        let deleteUserId = null;
        let deleteUserName = null;

        // Saat tombol delete diklik, simpan id user
        document.querySelectorAll('.btn-delete-user').forEach(function(btn) {
            btn.addEventListener('click', function() {
                deleteUserId = this.dataset.id;
                deleteUserName = this.dataset.name;
                // Ubah pesan modal jika mau
                document.querySelector('#modal-danger h3').innerText = 'Hapus User?';
                document.querySelector('#modal-danger .text-secondary').innerText = 'Yakin ingin menghapus user "' + deleteUserName + '"?';
            });
        });

        // Saat tombol konfirmasi di modal diklik, submit form delete via JS
        document.getElementById('btn-confirm-delete').onclick = function(e) {
            if(deleteUserId) {
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
    });
    </script>
  </body>
</html>
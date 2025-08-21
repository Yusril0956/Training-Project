<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Daftar</title>
    <!-- CSS files -->
    <link href="{{asset('dist/css/tabler.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/demo.min.css?1692870487')}}" rel="stylesheet"/>
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
  <body  class=" d-flex flex-column">
    <script src="{{asset('dist/js/demo-theme.min.js?1692870487')}}"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{asset('logo.png')}}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
          </a>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        
        <form class="card card-md" action="/register" method="POST" autocomplete="off" novalidate>
          @csrf
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Buat akun baru</h2>

            <!-- Nama -->
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" name="name" placeholder="Enter name">
            </div>

            <!-- NIK -->
            <div class="mb-3">
              <label class="form-label">NIK</label>
              <input type="text" maxlength="16" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan">
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-3">
              <label class="form-label">Nomor Telepon</label>
              <input type="text" maxlength="15" class="form-control" name="phone" 
                    placeholder="Contoh: 081234567890" pattern="\d*">
            </div>

            <!-- Alamat Lengkap -->
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" name="address" rows="3" placeholder="Alamat lengkap"></textarea>
            </div>

            <!-- Kota -->
            <div class="mb-3">
              <label class="form-label">Kota</label>
              <input type="text" class="form-control" name="city" placeholder="Kota tempat tinggal">
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label class="form-label">Alamat Email</label>
              <input type="email" class="form-control" name="email" placeholder="masukan email">
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="password"  placeholder="Password" autocomplete="off">
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" 
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                      <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6
                              c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                  </a>
                </span>
              </div>
            </div>

            <!-- Checkbox -->
            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Agree the 
                  <a href="./terms-of-service.html" tabindex="-1">ketentuan dan kebijakan</a>.
                </span>
              </label>
            </div>

            <!-- Submit -->
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Buat akun baru</button>
            </div>
          </div>
        </form>
        <div class="text-center text-secondary mt-3">
          Sudah memiliki akun? <a href="/login" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{asset('dist/js/tabler.min.js?1692870487')}}" defer></script>
    <script src="{{asset('dist/js/demo.min.js?1692870487')}}" defer></script>
  </body>
</html>
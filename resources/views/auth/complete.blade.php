<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Daftar</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />

    {{-- icon --}}
    <link rel="icon" href="{{ asset('LogoBaru.png') }}" type="image/svg+xml">
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

<body class=" d-flex flex-column">
    <script src="{{ asset('dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('index') }}" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('LogoBaru.png') }}" width="110" height="32" alt="Tabler"
                        class="navbar-brand-image" loading="lazy">
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

            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Complete your profile</h2>

                    <form action="{{ url('/register') }}" method="POST" autocomplete="off" novalidate>
                        @csrf
                        <!-- NIK -->
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" maxlength="16" class="form-control @error('nik') is-invalid @enderror"
                                name="nik" value="{{ old('nik') }}" placeholder="Nomor Induk Kependudukan"
                                required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" maxlength="15"
                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" placeholder="Contoh: 081234567890" pattern="\d*" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3"
                                placeholder="Alamat lengkap" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kota -->
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                name="city" value="{{ old('city') }}" placeholder="Kota tempat tinggal" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                </div>

                <!-- Submit -->
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1692870487') }}" defer></script>
</body>

</html>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Page 404 - {{config('app.name')}}</title>
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
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <script src="{{asset('dist/js/demo-theme.min.js?1692870487')}}"></script>
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="empty">
          <div class="empty-header">403</div>
          <p class="empty-title">Oops… Anda tidak bisa akses ini</p>
          <p class="empty-subtitle text-secondary">
            USer tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda yakin ini adalah kesalahan.
          </p>
          <div class="gif-placeholder rounded-2xl w-64 h-45 mx-auto mb-8 flex items-center justify-center">
            <div class="text-center">
                <img src="{{ asset('sus.gif') }}" width="350" height="220" alt="Tabler">
            </div>
          <div class="empty-action">
            <p class="empty-subtitle text-secondary">
            Ngapain coba-coba masuk sini, kamu bukan siapa-siapa! Kembali ke halaman utama aja deh.
          </p>
          <p class="empty-title">(˶˃⤙˂˶)</p>
          <div class="empty-action">
            <p class="empty-subtitle text-secondary">
            Hmph!
          </p>
            <a href="{{route('index')}}" class="btn btn-primary">
              <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
              Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{asset('dist/js/tabler.min.js?1692870487')}}" defer></script>
    <script src="{{asset('dist/js/demo.min.js?1692870487')}}" defer></script>
  </body>
</html>
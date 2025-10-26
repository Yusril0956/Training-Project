<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'app.name') | {{ config('app.name') }}</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('LogoBaru.png') }}" />
    @vite('resources/js/app.js')
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @stack('styles')
    @livewireStyles
</head>

<body>
    <script src="{{ asset('dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">

        @include('partials._navbar')
        <div class="page-wrapper">

            @include('components.alerts')

            @isset($slot)
                {{ $slot }}
            @endisset

            @yield('content')

            @include('partials._footer')
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('dist/libs/list.js/dist/list.min.js?1692870487') }}" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo-theme.min.js?1692870487') }}"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>

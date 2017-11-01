<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administration | {{ config('app.name') }}</title>

    <!-- Styles -->
    @if (!$hmr)
    <link rel="stylesheet" href="{{ assets('css/backend.css') }}">
    @endif
</head>
<body class="app @yield('body_class')">
    @yield('body')

    @yield('scripts_settings')

    <!-- Scripts -->
    <script>
        window.CKEDITOR_BASEPATH = '/vendor/ckeditor/';
    </script>
    <script src="{{ assets('js/manifest.js') }}"></script>
    <script src="{{ assets('js/vendor.js') }}"></script>
    <script src="{{ assets('js/vendor_backend.js') }}"></script>
    <script src="{{ assets('js/ckeditor.js') }}"></script>
    <script src="{{ assets('js/backend.js') }}"></script>
</body>
</html>

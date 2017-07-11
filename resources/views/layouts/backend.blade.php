<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    <title>@yield('title') | {{ config('app.name') }}</title>
    @else
    <title>Administration | {{ config('app.name') }}</title>
    @endif

    <!-- Custom Styles -->
    @if (!$hmr)
    <link rel="stylesheet" href="{{ assets('css/backend.css') }}">
    @endif
    @yield('styles')
</head>
<body class="app @yield('body_class')">
    @yield('body')

    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([]) !!}
    </script>

    <!-- Scripts -->
    <script>
        window.CKEDITOR_BASEPATH = '/vendor/ckeditor/';
    </script>
    <script src="{{ assets('js/manifest.js') }}"></script>
    <script src="{{ assets('js/vendor.js') }}"></script>
    <script src="{{ assets('js/ckeditor.js') }}"></script>
    <script src="{{ assets('js/backend.js') }}"></script>

    @if (app()->getLocale() !== 'en')
        <script src="{{ assets('i18n/select2.' . app()->getLocale() . '.js') }}"></script>
    @endif

    @yield('scripts')
</body>
</html>

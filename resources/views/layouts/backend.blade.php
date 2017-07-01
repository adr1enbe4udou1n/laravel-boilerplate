<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administration | {{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Custom Styles -->
    @if (!$hmr)
    <link rel="stylesheet" href="{{ assets('css/backend.css') }}">
    @endif
    @yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini @yield('body_class')">
    <div id="app">
        @yield('body')
    </div>

    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([]) !!}
    </script>

    <!-- Scripts -->
    <script src="{{ assets('js/manifest.js') }}"></script>
    <script src="{{ assets('js/vendor.js') }}"></script>
    <script src="{{ assets('js/backend.js') }}"></script>

    @if (app()->getLocale() !== 'en')
        <script src="{{ assets('i18n/moment.' . app()->getLocale() . '.js') }}"></script>
        <script src="{{ assets('i18n/select2.' . app()->getLocale() . '.js') }}"></script>
    @endif

    @yield('scripts')
</body>
</html>

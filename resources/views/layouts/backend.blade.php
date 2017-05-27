<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administration | {{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ assets('css/backend.css') }}">
    @yield('styles')
</head>
<body id="@yield('body_id')" class="hold-transition skin-blue sidebar-mini @yield('body_class')">
    @yield('body')

    <!-- Scripts -->
    <script src="{{ assets('js/manifest.js') }}"></script>
    <script src="{{ assets('js/vendor.js') }}"></script>
    <script src="{{ assets('js/backend.js') }}"></script>

    @if (config('app.locale') != 'en')
        <script src="{{ assets('i18n/moment.' . config('app.locale') . '.js') }}"></script>
        <script src="{{ assets('i18n/select2.' . config('app.locale') . '.js') }}"></script>
    @endif

    @yield('scripts')
</body>
</html>

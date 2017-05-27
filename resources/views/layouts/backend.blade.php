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
    @if(app()->environment('production'))
        <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
    @endif
    @yield('styles')
</head>
<body id="@yield('body_id')" class="hold-transition skin-blue sidebar-mini @yield('body_class')">
    @yield('body')

    <!-- Scripts -->
    @if(app()->environment('production'))
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/backend.js') }}"></script>
    @else
        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/backend.js') }}"></script>
    @endif

    @if (config('app.locale') != 'en')
        <script src="{{ asset('i18n/moment.' . config('app.locale') . '.js') }}"></script>
        <script src="{{ asset('i18n/select2.' . config('app.locale') . '.js') }}"></script>
    @endif

    @yield('scripts')
</body>
</html>

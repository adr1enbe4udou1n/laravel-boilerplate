<!DOCTYPE html>
<html lang="fr">
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
        <link rel="stylesheet" href="{{ elixir('css/backend.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
    @endif
    @yield('styles')
</head>
<body id="@yield('body_id')" class="hold-transition skin-blue sidebar-mini @yield('body_class')">
@yield('body')

@if(app()->environment('production'))
    <script src="{{ elixir('js/backend.js') }}"></script>
@else
    <script src="{{ asset('js/backend.js') }}"></script>
@endif

<script src="{{ asset('js/i18n/select2.fr.js') }}"></script>
@yield('scripts')
</body>
</html>

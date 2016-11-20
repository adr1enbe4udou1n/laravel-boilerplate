<!DOCTYPE html>
<html lang="fr">
<head>
    @include('frontend.scripts.gtm')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or '' }} | {{ config('app.name') }}</title>

    <meta name="description" content="{{ $description or '' }}">
    @yield('meta')

    <!-- Styles -->
    @if(app()->environment('production'))
        <link rel="stylesheet" href="{{ elixir('css/frontend.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    @endif
    @yield('styles')
</head>
<body id="@yield('body_id')" class="@yield('body_class')">
    @include('frontend.scripts.gtmiframe')

    <div id="app">
        @include('frontend.partials.header')
        @include('frontend.partials.nav')

        <div class="container">
            @include('partials.messages')
            @yield('content')
        </div>
    </div>

    @include('frontend.partials.footer')

    <!-- Scripts -->
    @if(app()->environment('production'))
        <script src="{{ elixir('js/frontend.js') }}"></script>
    @else
        <script src="{{ asset('js/frontend.js') }}"></script>
    @endif

    <script src="{{ asset('js/i18n/select2.fr.js') }}"></script>
    @yield('scripts')
</body>
</html>

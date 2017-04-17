<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('frontend.scripts.gtm')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or config('app.name') }}</title>

    @if (!empty($description))
    <meta name="description" content="{{ $description }}">
    @endif
    @yield('metas')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/frontend.css') }}">
    @yield('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
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
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>

    @if (config('app.locale') != 'en')
        <script src="{{ asset('i18n/moment.' . config('app.locale') . '.js') }}"></script>
        <script src="{{ asset('i18n/select2.' . config('app.locale') . '.js') }}"></script>
    @endif

    @yield('scripts')
</body>
</html>

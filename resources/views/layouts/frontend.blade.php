<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('frontend.scripts.gtm')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEOMeta::generate() !!}

    @if (count(config('laravellocalization.supportedLocales')) > 1)
    @include('partials.alternates')
    @endif
    @yield('metas')

    <!-- Styles -->
    @if (!$hmr)
    <link rel="stylesheet" href="{{ assets('css/frontend.css') }}">
    @endif
    @yield('styles')
</head>
<body class="@yield('body_class')">
    @include('frontend.scripts.gtmiframe')

    <div id="app">
        @include('partials.logged-as')
        @include('partials.not-confirmed')
        @include('frontend.partials.header')
        @hasSection('highlight')
            <section class="highlight">
                @yield('highlight')
            </section>
        @endif

        @if(Breadcrumbs::exists() && !request()->is('/'))
            <section class="nav-breadcrumb bg-dark">
                <div class="container">
                    {!! Breadcrumbs::render() !!}
                </div>
            </section>
        @endif

        <div class="main-container container py-4">
            @hasSection('title')
                <h1 class="mb-4">@yield('title')</h1>
            @endif
            @include('partials.messages')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    @include('frontend.partials.footer')

    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([
            'cookieconsent' => [
                'message' => trans('labels.cookieconsent.message'),
                'dismiss' => trans('labels.cookieconsent.dismiss'),
            ],
        ]) !!}
    </script>

    <!-- Scripts -->
    <script src="{{ assets('js/manifest.js') }}"></script>
    <script src="{{ assets('js/vendor.js') }}"></script>
    <script src="{{ assets('js/frontend.js') }}"></script>

    @yield('scripts')
</body>
</html>

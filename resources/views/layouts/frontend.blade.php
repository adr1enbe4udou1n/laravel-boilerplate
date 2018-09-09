<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
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

    <!-- Styles -->
    @if ($stylePath = Html::asset('frontend', 'frontend.css'))
    <link rel="stylesheet" href="{{ $stylePath }}">
    @endif

    <!-- CDN -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.6/cookieconsent.min.css">
    <script defer src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.6/cookieconsent.min.js"></script>

    <script defer src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script defer src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script defer src="//stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    <script defer src="{{ Html::asset('frontend', 'vendor-frontend.js') }}"></script>
    <script defer src="{{ Html::asset('frontend', 'frontend.js') }}"></script>

    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([
            'cookieconsent' => [
                'message' => __('labels.cookieconsent.message'),
                'dismiss' => __('labels.cookieconsent.dismiss'),
            ],
        ]) !!}
    </script>
</head>
<body class="@yield('body_class')">
    @include('frontend.scripts.gtmiframe')

    <div id="app">
        @include('partials.logged-as')
        @include('frontend.partials.header')
        @hasSection('highlight')
            <section class="highlight">
                @yield('highlight')
            </section>
        @endif

        @if(Breadcrumbs::exists() && !request()->routeIs('home'))
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

        @include('frontend.partials.footer')
    </div>

    @stack('scripts')
</body>
</html>

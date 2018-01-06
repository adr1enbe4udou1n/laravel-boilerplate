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
    @if ($stylePath = Html::asset('backend.css'))
    <link rel="stylesheet" href="{{ $stylePath }}">
    @endif
</head>
<body class="app @yield('body_class')">
    @yield('body')

    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([
            'locale' => app()->getLocale(),
            'appName' => config('app.name'),
            'homePath' => route('home'),
            'adminHomePath' => route('admin.home', [], false),
            'adminPathName' => config('app.admin_path'),
            'editorName' => config('app.editor_name'),
            'editorSiteUrl' => config('app.editor_site_url'),
            'locales' => LaravelLocalization::getSupportedLocales(),
            'user' => $loggedInUser,
            'permissions' => session()->get('permissions'),
            'isImpersonation' => session()->has('admin_user_id') && session()->has('temp_user_id'),
            'usurperName' => session()->get('admin_user_name'),
            'blogEnabled' => config('blog.enabled')
        ]) !!}
    </script>

    <!-- Named routes -->
    @routes()

    <!-- CDN -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script defer src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>

    <!-- Scripts -->
    <script defer src="{{ Html::asset('manifest.js') }}"></script>
    <script defer src="{{ Html::asset('locales.js') }}"></script>
    <script defer src="{{ Html::asset('vendor_backend.js') }}"></script>
    <script defer src="{{ Html::asset('backend.js') }}"></script>

    @stack('scripts')
</body>
</html>

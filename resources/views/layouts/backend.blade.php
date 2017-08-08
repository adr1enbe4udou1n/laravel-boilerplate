<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administration | {{ config('app.name') }}</title>

    <!-- Custom Styles -->
    @if (!$hmr)
    <link rel="stylesheet" href="{{ assets('css/backend.css') }}">
    @endif
</head>
<body class="app @yield('body_class')">
    @yield('body')

    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([
            'app' => [
                'name' => config('app.name'),
                'admin_path_name' => config('app.admin_path'),
                'admin_path' => route('admin.home', [], false),
                'editor_name' => config('app.editor_name'),
                'editor_site_url' => config('app.editor_site_url')
            ],
            'locales' => LaravelLocalization::getSupportedLocales(),
            'user' => auth()->user(),
            'is_impersonation' => session()->has('admin_user_id') && session()->has('temp_user_id'),
            'usurper_name' => session()->get('admin_user_name'),
            'blog' => [
                'enabled' => config('blog.enabled')
            ]
        ]) !!}
    </script>

    <!-- Scripts -->
    <script>
        window.CKEDITOR_BASEPATH = '/vendor/ckeditor/';
    </script>
    <script src="{{ assets('js/manifest.js') }}"></script>
    <script src="{{ assets('js/vendor.js') }}"></script>
    <script src="{{ assets('js/ckeditor.js') }}"></script>
    <script src="{{ assets('js/backend.js') }}"></script>

    @yield('scripts')
</body>
</html>

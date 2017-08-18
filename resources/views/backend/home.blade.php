@extends('layouts.backend')

@section('body_class', 'header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden')

@section('body')
    <div id="app"></div>
@endsection

@section('scripts_settings')
    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([
            'app' => [
                'name' => config('app.name'),
                'home_path' => route('home'),
                'admin_path_name' => config('app.admin_path'),
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

    <!-- Named routes -->
    @routes()
@endsection

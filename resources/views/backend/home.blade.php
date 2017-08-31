@extends('layouts.backend')

@section('body_class', 'header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden')

@section('body')
    <div id="app"></div>
@endsection

@section('scripts_settings')
    <!-- JS settings -->
    <script type="application/json" data-settings-selector="settings-json">
        {!! json_encode([
            'appName' => config('app.name'),
            'homePath' => route('home'),
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
@endsection

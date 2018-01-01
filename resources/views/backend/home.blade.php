@extends('layouts.backend')

@section('body_class', 'header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden')

@section('body')
    <div id="app"></div>
@endsection

@push('scripts')
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

    <!-- Scripts -->
    <script src="{{ Html::asset('manifest.js') }}"></script>
    <script src="{{ Html::asset('vendor.js') }}"></script>
    <script src="{{ Html::asset('vendor_backend.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
    <script src="{{ Html::asset('locales.js') }}"></script>
    <script src="{{ Html::asset('backend.js') }}"></script>
@endpush

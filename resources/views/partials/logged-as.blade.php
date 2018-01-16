@if (session()->has('admin_user_id') && session()->has('temp_user_id'))
    <div class="alert alert-warning alert-top">
        @lang('labels.alerts.login_as', ['name' => auth()->user()->name, 'route' => route('logout'), 'admin' => session()->get('admin_user_name') ])
    </div>
@endif

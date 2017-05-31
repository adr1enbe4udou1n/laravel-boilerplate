@if (session()->has('admin_user_id') && session()->has('temp_user_id'))
    <div class="alert alert-warning logged-in-as">
        @lang('labels.backend.login-as', ['name' => auth()->user()->name, 'route' => route('logout-as'), 'admin' => session()->get('admin_user_name') ])
    </div><!--alert alert-warning logged-in-as-->
@endif
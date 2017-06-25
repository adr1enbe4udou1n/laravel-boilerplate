<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $logged_in_user->avatar }}" class="img-circle" alt="@lang('labels.user.avatar')">
            </div>
            <div class="pull-left info">
                <p>{{ $logged_in_user->name }}</p>
                {{ $logged_in_user->formatted_roles }}
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">@lang('labels.general')</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ active_class(if_route_pattern('admin.home')) }}"><a href="{{ route('admin.home') }}"><i class="fa fa-tachometer"></i> <span>@lang('labels.backend.titles.dashboard')</span></a></li>

            @if(config('blog.enabled') && Gate::check('manage own posts'))
            <li class="header">@lang('labels.backend.sidebar.content')</li>
            {!! menu_item_access('admin.post.create', trans('labels.backend.posts.titles.create'), 'fa fa-plus') !!}
            {!! menu_item_access('admin.post.index', trans('labels.backend.posts.titles.main'), 'fa fa-newspaper-o', [], null, [], 'admin.post.edit') !!}
            @endif

            @if(Gate::check('manage form_submissions') || Gate::check('manage form_settings'))
            <li class="header">@lang('labels.backend.sidebar.forms')</li>
            {!! menu_item_access('admin.form_submission.index', trans('labels.backend.form_submissions.titles.main'), 'fa fa-id-card-o', [], 'manage form_submissions', [], 'admin.form_submission.*') !!}
            {!! menu_item_access('admin.form_setting.index', trans('labels.backend.form_settings.titles.main'), 'fa fa-wrench', [], 'manage form_settings', [], 'admin.form_setting.*') !!}
            @endif

            @if(Gate::check('manage users') || Gate::check('manage roles'))
            <li class="header">@lang('labels.backend.sidebar.access')</li>
            {!! menu_item_access('admin.user.create', trans('labels.backend.users.titles.create'), 'fa fa-plus', [], 'manage users') !!}
            {!! menu_item_access('admin.user.index', trans('labels.backend.users.titles.main'), 'fa fa-users', [], 'manage users', [], 'admin.user.edit') !!}
            {!! menu_item_access('admin.role.index', trans('labels.backend.roles.titles.main'), 'fa fa-shield', [], 'manage roles', [], 'admin.role.*') !!}
            @endif

            @if(Gate::check('manage metas') || Gate::check('manage redirections'))
            <li class="header">@lang('labels.backend.sidebar.seo')</li>
            {!! menu_item_access('admin.meta.create', trans('labels.backend.metas.titles.create'), 'fa fa-plus', [], 'manage metas') !!}
            {!! menu_item_access('admin.meta.index', trans('labels.backend.metas.titles.main'), 'fa fa-tags', [], 'manage metas', [], 'admin.meta.edit') !!}
            {!! menu_item_access('admin.redirection.index', trans('labels.backend.redirections.titles.main'), 'fa fa-forward', [], 'manage redirections', [], 'admin.redirection.*') !!}
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
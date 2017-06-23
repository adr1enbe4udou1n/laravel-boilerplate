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

            @if(Gate::check('manage posts'))
                <li class="header">@lang('labels.backend.sidebar.content')</li>
                {!! menu_item_access('admin.post.create', '<i class="fa fa-plus"></i><span>' . trans('labels.backend.posts.titles.create') . '</span>', [], 'manage posts') !!}
                {!! menu_item_access('admin.post.index', '<i class="fa fa-newspaper-o"></i><span>' . trans('labels.backend.posts.titles.main') . '</span>', [], 'manage posts', [], 'admin.post.edit') !!}
            @endif

            @if(Gate::check('manage form_submissions') || Gate::check('manage form_settings'))
            <li class="header">@lang('labels.backend.sidebar.forms')</li>
            {!! menu_item_access('admin.form_submission.index', '<i class="fa fa-id-card-o"></i><span>' . trans('labels.backend.form_submissions.titles.main') . '</span>', [], 'manage form_submissions', [], 'admin.form_submission.*') !!}
            {!! menu_item_access('admin.form_setting.index', '<i class="fa fa-wrench"></i><span>' . trans('labels.backend.form_settings.titles.main') . '</span>', [], 'manage form_settings', [], 'admin.form_setting.*') !!}
            @endif

            @if(Gate::check('manage users') || Gate::check('manage roles'))
            <li class="header">@lang('labels.backend.sidebar.access')</li>
            {!! menu_item_access('admin.user.create', '<i class="fa fa-plus"></i><span>' . trans('labels.backend.users.titles.create') . '</span>', [], 'manage users') !!}
            {!! menu_item_access('admin.user.index', '<i class="fa fa-users"></i><span>' . trans('labels.backend.users.titles.main') . '</span>', [], 'manage users', [], 'admin.user.edit') !!}
            {!! menu_item_access('admin.role.index', '<i class="fa fa-shield"></i><span>' . trans('labels.backend.roles.titles.main') . '</span>', [], 'manage roles', [], 'admin.role.*') !!}
            @endif

            @if(Gate::check('manage metas') || Gate::check('manage redirections'))
            <li class="header">@lang('labels.backend.sidebar.seo')</li>
            {!! menu_item_access('admin.meta.create', '<i class="fa fa-plus"></i><span>' . trans('labels.backend.metas.titles.create') . '</span>', [], 'manage metas') !!}
            {!! menu_item_access('admin.meta.index', '<i class="fa fa-tags"></i><span>' . trans('labels.backend.metas.titles.main') . '</span>', [], 'manage metas', [], 'admin.meta.edit') !!}
            {!! menu_item_access('admin.redirection.index', '<i class="fa fa-forward"></i><span>' . trans('labels.backend.redirections.titles.main') . '</span>', [], 'manage redirections', [], 'admin.redirection.*') !!}
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
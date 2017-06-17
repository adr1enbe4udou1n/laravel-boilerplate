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

            {!! menu_header_access(trans('labels.backend.sidebar.forms'), 'admin.form_submission.index') !!}
            {!! menu_item_access('admin.form_submission.index', '<i class="fa fa-id-card-o"></i><span>' . trans('labels.backend.form_submissions.titles.main') . '</span>', [], 'admin.form_submission.*') !!}
            {!! menu_item_access('admin.form_setting.index', '<i class="fa fa-wrench"></i><span>' . trans('labels.backend.form_settings.titles.main') . '</span>', [], 'admin.form_setting.*') !!}
            {!! menu_header_access(trans('labels.backend.sidebar.access'), 'admin.user.index', 'admin.role.index') !!}
            {!! menu_item_access('admin.user.index', '<i class="fa fa-users"></i><span>' . trans('labels.backend.users.titles.main') . '</span>', [], 'admin.user.*') !!}
            {!! menu_item_access('admin.role.index', '<i class="fa fa-shield"></i><span>' . trans('labels.backend.roles.titles.main') . '</span>', [], 'admin.role.*') !!}
            {!! menu_header_access(trans('labels.backend.sidebar.seo'), 'admin.meta.index') !!}
            {!! menu_item_access('admin.meta.index', '<i class="fa fa-tags"></i><span>' . trans('labels.backend.metas.titles.main') . '</span>', [], 'admin.meta.*') !!}
            {!! menu_item_access('admin.redirection.index', '<i class="fa fa-forward"></i><span>' . trans('labels.backend.redirections.titles.main') . '</span>', [], 'admin.redirection.*') !!}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
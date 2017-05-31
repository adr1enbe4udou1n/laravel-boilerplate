<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">@lang('labels.general')</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ active_class(if_route_pattern('admin.home')) }}"><a href="{{ route('admin.home') }}"><i class="fa fa-tachometer"></i> <span>@lang('labels.backend.titles.dashboard')</span></a></li>
            @can('manage users')
                <li class="{{ active_class(if_route_pattern('admin.user.*')) }}"><a href="{{ route('admin.user.index') }}"><i class="fa fa-users"></i> <span>@lang('labels.backend.users.titles.main')</span></a></li>
            @endcan
            @can('manage roles')
                <li class="{{ active_class(if_route_pattern('admin.role.*')) }}"><a href="{{ route('admin.role.index') }}"><i class="fa fa-shield"></i> <span>@lang('labels.backend.roles.titles.main')</span></a></li>
            @endcan
            @can('manage metas')
                <li class="{{ active_class(if_route_pattern('admin.meta.*')) }}"><a href="{{ route('admin.meta.index') }}"><i class="fa fa-tags"></i> <span>@lang('labels.backend.metas.titles.main')</span></a></li>
            @endcan
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
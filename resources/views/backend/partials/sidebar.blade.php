<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">@lang('labels.general')</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ active_class(if_route_pattern('admin.dashboard')) }}"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> <span>@lang('labels.backend.titles.dashboard')</span></a></li>
            @can('manage-users')
                <li class="{{ active_class(if_route_pattern('admin.user.*')) }}"><a href="{{ route('admin.user.index') }}"><i class="fa fa-user"></i> <span>@lang('labels.backend.users.titles.main')</span></a></li>
            @endcan
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
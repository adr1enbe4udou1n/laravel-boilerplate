<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SP</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ config('app.name') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (auth()->check())
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <p>
                                    {{ auth()->user()->name }}
                                    <small>@lang('labels.backend.users.member_since', ['date' => auth()->user()->created_at->format('d-m-Y')])</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-default btn-flat">@lang('labels.backend.users.profile')</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">@lang('labels.backend.users.logout')</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
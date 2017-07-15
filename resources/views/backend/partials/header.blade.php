<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
    <a class="navbar-brand" href="{{ route('home') }}" target="_blank"></a>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto mr-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="d-md-down-none">@lang('labels.language')</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @include('partials.locales')
            </div>
        </li>
        @if (auth()->check())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ $logged_in_user->avatar }}" class="img-avatar" alt="@lang('labels.user.avatar')">
                <span class="d-md-down-none">{{ $logged_in_user->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>

                <a class="dropdown-item" href="{{ route('user.account') }}"><i class="icon-user"></i> @lang('labels.user.profile')</a>
                <a class="dropdown-item" href="{{ route('logout') }}"><i class="icon-logout"></i> @lang('labels.user.logout')</a>
            </div>
        </li>
        @endif
    </ul>
</header>

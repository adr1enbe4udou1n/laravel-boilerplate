<header class="header">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="{{ active_class(if_route('home')) }}"><a href="{{ route('home') }}"><i
                                    class="fa fa-home"></i></a></li>
                    <li class="{{ active_class(if_route('about')) }}"><a
                                href="{{ route('about') }}">@lang('labels.frontend.titles.about')</a></li>
                    <li class="{{ active_class(if_route('contact')) }}"><a
                                href="{{ route('contact') }}">@lang('labels.frontend.titles.contact')</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if (count(config('laravellocalization.supportedLocales')) > 1)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ trans('labels.language') }}
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @include('partials.locales')
                            </ul>
                        </li>
                    @endif
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">@lang('labels.user.login')</a></li>
                        @if (has_access('register'))
                            <li><a href="{{ route('register') }}">@lang('labels.user.register')</a></li>
                        @endif
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ $logged_in_user->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('user.home') }}">@lang('labels.user.space')</a></li>
                                <li><a href="{{ route('user.account') }}">@lang('labels.user.account')</a></li>
                                @can('access backend')
                                    <li><a href="{{ route('admin.home') }}">@lang('labels.user.administration')</a></li>
                                @endcan
                                <li><a href="{{ route('logout') }}">@lang('labels.user.logout')</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

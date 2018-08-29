<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsMain" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>

        <div class="collapse navbar-collapse" id="navbarsMain">
            <div class="navbar-nav mr-auto">
                <a class="nav-link {{ active_class(if_route('home')) }}" href="{{ route('home') }}">
                    <font-awesome-icon icon="home"></font-awesome-icon>
                </a>
                <a class="nav-link {{ active_class(if_route('about')) }}"
                   href="{{ route('about') }}">@lang('labels.frontend.titles.about')</a>
                @if(config('blog.enabled'))
                    <a class="nav-link {{ active_class(if_route_pattern('blog.*')) }}"
                       href="{{ route('blog.index') }}">@lang('labels.frontend.titles.blog')</a>
                @endif
                <a class="nav-link {{ active_class(if_route('contact')) }}"
                   href="{{ route('contact') }}">@lang('labels.frontend.titles.contact')</a>
            </div>

            <div class="navbar-nav">
                @if (count(config('laravellocalization.supportedLocales')) > 1)
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('labels.language') }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            @include('partials.locales')
                        </div>
                    </div>
                @endif
                @guest
                    <a class="nav-link" href="{{ route('login') }}">@lang('labels.user.login')</a>
                    @if (config('account.can_register'))
                        <a class="nav-link" href="{{ route('register') }}">@lang('labels.user.register')</a>
                    @endif
                @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $loggedInUser->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="{{ route('user.home') }}">@lang('labels.user.space')</a>
                            <a class="dropdown-item" href="{{ route('user.account') }}">@lang('labels.user.account')</a>
                            @can('access backend')
                                <a class="dropdown-item" href="{{ route('admin.home') }}" data-turbolinks="false">@lang('labels.user.administration')</a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('logout') }}" data-turbolinks="false">@lang('labels.user.logout')</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>

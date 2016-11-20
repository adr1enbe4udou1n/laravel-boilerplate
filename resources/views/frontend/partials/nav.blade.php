<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="{{ active_class(if_route('home')) }}"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                <li class="{{ active_class(if_route('about')) }}"><a href="{{ route('about') }}">Qui sommes-nous</a></li>
                <li class="{{ active_class(if_route('contact')) }}"><a href="{{ route('contact') }}">Contact</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>
    </div>
</nav>

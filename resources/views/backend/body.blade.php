@extends('layouts.backend')

@section('body_class', 'header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden')

@section('body')
    @include('backend.partials.header')
    <div id="app" class="app-body">
        @include('backend.partials.sidebar')

        <main class="main">
            {!! Breadcrumbs::renderIfExists() !!}

            <div class="container-fluid">
                @include('partials.logged-as')
                @include('partials.not-confirmed')

                <div class="animated fadeIn">
                    <!-- Your Page Content Here -->
                    @include('partials.messages')
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @include('backend.partials.footer')
@endsection
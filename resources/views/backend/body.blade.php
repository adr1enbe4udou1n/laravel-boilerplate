@extends('layouts.backend')

@section('body')
    <div class="wrapper">
        @include('backend.partials.header')
        @include('backend.partials.sidebar')

        <div class="content-wrapper">
            @include('partials.logged-as')

            <section class="content-header">
                <h1>
                    @yield('header_title')
                    <small>@yield('header_description')</small>
                </h1>

                {!! Breadcrumbs::renderIfExists() !!}
            </section>

            <section class="content">
                <!-- Your Page Content Here -->
                @include('partials.messages')
                @yield('content')
            </section>
        </div>

        @include('backend.partials.footer')
    </div>
    <!-- ./wrapper -->
@endsection
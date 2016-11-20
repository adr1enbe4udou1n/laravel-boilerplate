@extends('layouts.backend')

@section('body')
    <div class="wrapper">
        @include('backend.partials.header')
        @include('backend.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('backend.partials.logged-as')

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('header-title')
                    <small>@yield('header-description')</small>
                </h1>

                {!! Breadcrumbs::renderIfExists() !!}
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                @include('partials.messages')
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('backend.partials.footer')
    </div>
    <!-- ./wrapper -->
@endsection
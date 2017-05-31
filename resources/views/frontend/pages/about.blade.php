@extends('layouts.frontend')

@section('title', trans('labels.frontend.titles.about'))

@section('body_id', 'page-about')

@section('highlight')
    @component('frontend.components.highlight')
        <h1>Hello, world!</h1>
        <p>Contents...</p>
        <p>
            <a class="btn btn-primary btn-lg">Learn more</a>
        </p>
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-home"></i> @lang('labels.frontend.titles.about')
                </div>

                <div class="panel-body">
                    <p>
                        Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh. Vivamus suscipit tortor
                        eget felis porttitor volutpat. Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget
                        felis porttitor volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                        posuere
                        cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet
                        nisl
                        tempus convallis quis ac lectus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at
                        sem.
                        Quisque velit nisi, pretium ut lacinia in, elementum id enim.
                    </p>
                </div>
            </div>

            <panel title="Vue Panel Component" v-cloak>
                <p>Hey ! I'm a Vue Panel component !</p>
            </panel>

            <div class="panel panel-default">
                <div class="panel-heading">
                    This panel show original 4K images samples optimized by imagecache intervention laravel package
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <img src="{{ url(config('imagecache.route') . '/large/wallpapers-uhd/03908_halfdomejoy_3840x2160.jpg') }}" alt="halfdomejoy" width="480" height="360" class="img-responsive">
                        </div>
                        <div class="col-xs-4">
                            <img src="{{ url(config('imagecache.route') . '/large/wallpapers-uhd/03909_insidebrycecanyon_3840x2160.jpg') }}" alt="insidebrycecanyon" width="480" height="360" class="img-responsive">
                        </div>
                        <div class="col-xs-4">
                            <img src="{{ url(config('imagecache.route') . '/large/wallpapers-uhd/03987_forestsofendor_3840x2160.jpg') }}" alt="forestsofendor" width="480" height="360" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

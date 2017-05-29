@extends('layouts.frontend')

@section('body_id', 'page-home')

@section('highlight')
    @component('frontend.components.highlight')
        @include('frontend.partials.slider')
    @endcomponent
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-home"></i> @lang('labels.frontend.home')
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
        </div>

        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Bootstrap
                    Glyphicon
                </div>

                <div class="panel-body">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    <span class="glyphicon glyphicon glyphicon-euro" aria-hidden="true"></span>
                    <span class="glyphicon glyphicon glyphicon-cloud" aria-hidden="true"></span>
                    <span class="glyphicon glyphicon glyphicon-envelope" aria-hidden="true"></span>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Font Awesome</div>

                <div class="panel-body">
                    <i class="fa fa-home"></i>
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-pinterest"></i>
                </div>
            </div>
        </div>
    </div>

@endsection

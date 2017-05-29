@extends('layouts.frontend')

@section('body_id', 'page-about')

@section('title')
    <h1>@lang('labels.frontend.about')</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-home"></i> @lang('labels.frontend.about')
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

        <panel title="Vue Panel Component">
            <p>Hey ! I'm a Vue Panel component !</p>
        </panel>
    </div>
@endsection

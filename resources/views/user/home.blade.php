@extends('layouts.frontend')

@section('title')
    <h1>@lang('labels.user.titles.space')</h1>
@endsection

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">@lang('labels.user.dashboard')</div>

                <div class="panel-body">

                    <div class="row">

                        <div class="col-md-4 col-md-push-8">

                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            {{ $logged_in_user->name }}<br/>
                                            <small>
                                                {{ $logged_in_user->email }}<br/>
                                                @lang('labels.user.member_since', ['date' => $logged_in_user->created_at->formatLocalized('%A %d %B %Y')])
                                            </small>
                                        </h4>

                                        <a href="{{ route('user.account') }}" class="btn btn-info btn-xs">@lang('labels.user.account')</a>

                                        @can('access backend')
                                        <a href="{{ route('admin.home') }}" class="btn btn-danger btn-xs">@lang('labels.user.administration')</a>
                                        @endcan
                                    </div><!--media-body-->
                                </li><!--media-->
                            </ul><!--media-list-->

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Sidebar Item</h4>
                                </div><!--panel-heading-->

                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                                </div><!--panel-body-->
                            </div><!--panel-->

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Sidebar Item</h4>
                                </div><!--panel-heading-->

                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-4-->

                        <div class="col-md-8 col-md-pull-4">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Item</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-xs-12-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Item</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Item</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Item</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Item</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->

                            </div><!--row-->

                        </div><!--col-md-8-->

                    </div><!--row-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection

@extends('layouts.frontend')

@section('title', trans('labels.user.titles.space'))

@section('content')
        <div class="card">
            <div class="card-header">@lang('labels.user.dashboard')</div>

            <div class="card-block">
                <div class="row">
                    <div class="col-md-4 push-md-8">
                        <div class="media">
                            <img class="media-object mr-3" src="{{ $logged_in_user->avatar }}" alt="@lang('labels.user.avatar')">
                            <div class="media-body">
                                <h4>
                                    {{ $logged_in_user->name }}<br/>
                                </h4>

                                <small>
                                    {{ $logged_in_user->email }}<br/>
                                    @lang('labels.user.member_since', ['date' => $logged_in_user->created_at->formatLocalized('%A %d %B %Y')])
                                </small>

                                <p>
                                <a href="{{ route('user.account') }}" class="btn btn-info btn-sm">@lang('labels.user.account')</a>

                                @can('access backend')
                                <a href="{{ route('admin.home') }}" class="btn btn-danger btn-sm">@lang('labels.user.administration')</a>
                                @endcan
                                </p>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Sidebar Item</h4>
                            </div><!--card-header-->

                            <div class="card-block">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                            </div><!--card-block-->
                        </div><!--panel-->

                        <div class="card">
                            <div class="card-header">
                                <h4>Sidebar Item</h4>
                            </div><!--card-header-->

                            <div class="card-block">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                            </div><!--card-block-->
                        </div><!--panel-->
                    </div><!--col-md-4-->

                    <div class="col-md-8 pull-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Item</h4>
                            </div><!--card-header-->

                            <div class="card-block">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                            </div><!--card-block-->
                        </div><!--panel-->

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Item</h4>
                                    </div><!--card-header-->

                                    <div class="card-block">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                    </div><!--card-block-->
                                </div><!--panel-->
                            </div><!--col-md-6-->

                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Item</h4>
                                    </div><!--card-header-->

                                    <div class="card-block">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                    </div><!--card-block-->
                                </div><!--panel-->
                            </div><!--col-md-6-->

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Item</h4>
                                    </div><!--card-header-->

                                    <div class="card-block">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                    </div><!--card-block-->
                                </div><!--panel-->
                            </div><!--col-md-6-->

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Item</h4>
                                    </div><!--card-header-->

                                    <div class="card-block">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.</p>
                                    </div><!--card-block-->
                                </div><!--panel-->
                            </div><!--col-md-6-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

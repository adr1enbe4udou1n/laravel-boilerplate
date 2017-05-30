@extends('layouts.frontend')

@section('title')
    <h1>@lang('labels.user.titles.account')</h1>
@endsection

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="#profile" aria-controls="profile" role="tab"
                       data-toggle="tab">@lang('labels.user.profile')</a>
                </li>

                <li role="presentation">
                    <a href="#edit" aria-controls="edit" role="tab"
                       data-toggle="tab">@lang('labels.user.edit_profile')</a>
                </li>

                <li role="presentation">
                    <a href="#password" aria-controls="password" role="tab"
                       data-toggle="tab">@lang('labels.user.change_password')</a>
                </li>
            </ul>

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane" id="profile">
                    @include('user.account.profile')
                </div><!--tab panel profile-->

                <div role="tabpanel" class="tab-pane" id="edit">
                    @include('user.account.edit')
                </div><!--tab panel profile-->

                <div role="tabpanel" class="tab-pane" id="password">
                    @include('user.account.password')
                </div><!--tab panel change password-->

            </div><!--tab content-->

        </div><!-- col-xs-12 -->

    </div><!-- row -->
@endsection

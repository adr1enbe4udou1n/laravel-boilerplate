@extends('layouts.frontend')

@section('title', trans('labels.user.titles.account'))

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

                @if (config('account.can_delete'))
                <li role="presentation">
                    <a href="#delete" aria-controls="delete" role="tab"
                       data-toggle="tab">@lang('labels.user.delete')</a>
                </li>
                @endif
            </ul>

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane" id="profile">
                    @include('user.account.profile')
                </div>

                <div role="tabpanel" class="tab-pane" id="edit">
                    @include('user.account.edit')
                </div>

                <div role="tabpanel" class="tab-pane" id="password">
                    @include('user.account.password')
                </div>

                @if (config('account.can_delete'))
                <div role="tabpanel" class="tab-pane" id="delete">
                    @include('user.account.delete')
                </div>
                @endif

            </div><!--tab content-->

        </div><!-- col-xs-12 -->

    </div><!-- row -->
@endsection

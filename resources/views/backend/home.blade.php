@extends('backend.body')

@section('header_title', trans('labels.backend.titles.dashboard'))

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $new_posts_count }}</h3>

                            <p>@lang('labels.backend.dashboard.new_posts')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.post.index') }}"
                           class="small-box-footer">@lang('labels.more_info') <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $pending_posts_count }}</h3>

                            <p>@lang('labels.backend.dashboard.pending_posts')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.post.index') }}"
                           class="small-box-footer">@lang('labels.more_info') <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $published_posts_count }}</h3>

                            <p>@lang('labels.backend.dashboard.published_posts')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.post.index') }}"
                           class="small-box-footer">@lang('labels.more_info') <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @can('manage users')
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $active_users_count }}</h3>

                            <p>@lang('labels.backend.dashboard.active_users')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.user.index') }}"
                           class="small-box-footer">@lang('labels.more_info') <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                @can('manage form_submissions')
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $form_submissions_count }}</h3>

                            <p>@lang('labels.backend.dashboard.form_submissions')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.form_submission.index') }}"
                           class="small-box-footer">@lang('labels.more_info') <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('labels.backend.dashboard.last_posts')</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin" width="100%">
                                    <thead>
                                    <tr>
                                        <th>@lang('validation.attributes.title')</th>
                                        <th>@lang('validation.attributes.status')</th>
                                        <th>@lang('validation.attributes.pinned')</th>
                                        <th>@lang('validation.attributes.summary')</th>
                                        <th class="text-center" style="width: 100px">@lang('labels.published_at')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($posts as $post)
                                        <tr>
                                            <td>{{ link_to_route('admin.post.edit', $post->title, $post) }}</td>
                                            <td>{!! state_html_label($post->state, trans($post->status_label)) !!}</td>
                                            <td>{!! boolean_html_label($post->pinned) !!}</td>
                                            <td>{{ $post->summary }}</td>
                                            <td class="text-center">{{ $post->published_at }}</td>
                                        </tr>
                                    @empty
                                        <tr class="odd">
                                            <td valign="top" colspan="6"
                                                class="text-center">@lang('labels.no_results')</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{ route('admin.post.index') }}"
                               class="btn btn-sm btn-default btn-flat pull-right">@lang('labels.backend.dashboard.all_posts')</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

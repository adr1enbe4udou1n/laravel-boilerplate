@extends('backend.body')

@section('title', trans('labels.backend.titles.dashboard'))

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <div class="card card-inverse card-danger">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{ $new_posts_count }}</h4>
                            <p>@lang('labels.backend.dashboard.new_posts')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="card card-inverse card-warning">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{ $pending_posts_count }}</h4>
                            <p>@lang('labels.backend.dashboard.pending_posts')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="card card-inverse card-success">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{ $published_posts_count }}</h4>
                            <p>@lang('labels.backend.dashboard.published_posts')</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @can('manage users')
                <div class="col-lg-6 col-xs-6">
                    <div class="card card-inverse card-primary">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{ $active_users_count }}</h4>
                            <p>@lang('labels.backend.dashboard.active_users')</p>
                        </div>
                    </div>
                </div>
                @endcan
                @can('manage form_submissions')
                <div class="col-lg-6 col-xs-6">
                    <div class="card card-inverse card-info">
                        <div class="card-block pb-0">
                            <h4 class="mb-0">{{ $form_submissions_count }}</h4>
                            <p>@lang('labels.backend.dashboard.form_submissions')</p>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>@lang('labels.backend.dashboard.last_posts')</h3>
                </div>
                <div class="card-block">
                    <table class="table">
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
                            <tr>
                                <td valign="top" colspan="6"
                                    class="text-center">@lang('labels.no_results')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('admin.post.index') }}"
                       class="btn btn-primary pull-right">@lang('labels.backend.dashboard.all_posts')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

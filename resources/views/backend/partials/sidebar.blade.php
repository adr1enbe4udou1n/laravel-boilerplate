<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">@lang('labels.general')</li>
            <li class="nav-item"><a class="nav-link {{ active_class(if_route_pattern('admin.home')) }}" href="{{ route('admin.home') }}"><i class="icon-speedometer"></i> @lang('labels.backend.titles.dashboard')</a></li>

            @if(config('blog.enabled') && Gate::check('manage own posts'))
                <li class="nav-title">@lang('labels.backend.sidebar.content')</li>
                {!! menu_item_access('admin.post.create', trans('labels.backend.posts.titles.create'), 'icon-plus') !!}
                <li class="nav-item">
                    <a class="nav-link {{ active_class(if_route_pattern(['admin.post.index', 'admin.post.edit'])) }}" href="{{ route('admin.post.index') }}">
                        <i class="icon-notebook"></i> @lang('labels.backend.posts.titles.main')
                        @if($new_posts_count > 0)
                            <span class="badge badge-danger" title="@lang('labels.backend.dashboard.new_posts')">{{ $new_posts_count }}</span>
                        @endif
                        @if($pending_posts_count > 0)
                            <span class="badge badge-warning" title="@lang('labels.backend.dashboard.pending_posts')">{{ $pending_posts_count }}</span>
                        @endif
                    </a>
                </li>
            @endif

            @if(Gate::check('manage form_submissions') || Gate::check('manage form_settings'))
                <li class="nav-title">@lang('labels.backend.sidebar.forms')</li>
                {!! menu_item_access('admin.form_submission.index', trans('labels.backend.form_submissions.titles.main'), 'icon-list', 'manage form_submissions', [], 'admin.form_submission.*') !!}
                {!! menu_item_access('admin.form_setting.index', trans('labels.backend.form_settings.titles.main'), 'icon-equalizer', 'manage form_settings', [], 'admin.form_setting.*') !!}
            @endif

            @if(Gate::check('manage users') || Gate::check('manage roles'))
                <li class="nav-title">@lang('labels.backend.sidebar.access')</li>
                {!! menu_item_access('admin.user.create', trans('labels.backend.users.titles.create'), 'icon-plus', 'manage users') !!}
                {!! menu_item_access('admin.user.index', trans('labels.backend.users.titles.main'), 'icon-people', 'manage users', [], 'admin.user.edit') !!}
                {!! menu_item_access('admin.role.index', trans('labels.backend.roles.titles.main'), 'icon-shield', 'manage roles', [], 'admin.role.*') !!}
            @endif

            @if(Gate::check('manage metas') || Gate::check('manage redirections'))
                <li class="nav-title">@lang('labels.backend.sidebar.seo')</li>
                {!! menu_item_access('admin.meta.create', trans('labels.backend.metas.titles.create'), 'icon-plus', 'manage metas') !!}
                {!! menu_item_access('admin.meta.index', trans('labels.backend.metas.titles.main'), 'icon-tag', 'manage metas', [], 'admin.meta.edit') !!}
                {!! menu_item_access('admin.redirection.index', trans('labels.backend.redirections.titles.main'), 'icon-control-forward', 'manage redirections', [], 'admin.redirection.*') !!}
            @endif
        </ul>
    </nav>
</div>

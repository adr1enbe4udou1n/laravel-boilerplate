<footer class="app-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}" target="_blank">{{ config('app.name') }}</a>.</strong> @lang('labels.all_rights_reserved')
    <span class="float-right">
        @if (config('app.editor_name'))
            @if (config('app.editor_site_url'))
                <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <a href="{{ config('app.editor_site_url') }}" target="_blank"><strong>{{ config('app.editor_name') }}</strong></a>
            @else
                <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <strong>{{ config('app.editor_name') }}</strong>
            @endif
        @endif
    </span>
</footer>

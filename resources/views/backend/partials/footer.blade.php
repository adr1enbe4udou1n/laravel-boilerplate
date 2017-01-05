<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <a href="{{ config('app.editor_site_url') }}" target="_blank"><strong>{{ config('app.editor') }}</strong></a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}" target="_blank">{{ config('app.name') }}</a>.</strong> @lang('labels.all_rights_reserved')
</footer>
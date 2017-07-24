<div class="input-group">
    @if (isset($left))
        <span class="input-group-addon">{!! $left !!}</span>
    @endif

    {{{ $slot }}}

    @if (isset($right))
        <span class="input-group-addon">{!! $right !!}</span>
    @endif
</div>

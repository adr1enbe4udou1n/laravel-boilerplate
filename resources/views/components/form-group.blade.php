<div class="form-group @if($label_cols)row @endif">
    @isset($title)
        @if($label_cols)
        {{ Form::label($name, $title, ['class' => "col-md-{$label_cols} col-form-label"]) }}
        @else
        {{ Form::label($name, $title) }}
        @endif
    @endisset

    @if($label_cols)
    <div class="col-md-{{ (12 - $label_cols) }}">
    @endif

        {{{ $slot }}}

        @if ($errors->has($name))
        <div class="invalid-feedback">
            <span>{{ $errors->first($name) }}</span>
        </div>
        @endif

        @isset($description)
        <small class="form-text text-muted">
            {{ $description }}
        </small>
        @endif

    @if($label_cols)
    </div>
    @endif
</div>

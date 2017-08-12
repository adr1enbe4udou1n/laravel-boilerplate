<div class="form-group row{{ $errors->has($name) ? ' is-invalid' : '' }}" :class="{'is-invalid': errors.has('{{ $name }}') }">
    @isset($title)
    {{ Form::label($name, $title, ['class' => isset($horizontal) && $horizontal ? "col-md-{$label_cols} col-form-label" : 'col-12 form-control-label']) }}
    @endisset

    <div class="{{ isset($horizontal) && $horizontal ? 'col-md-' . (12 - $label_cols ) : 'col-12' }}">

        {{{ $slot }}}

        @if ($errors->has($name))
            <div class="invalid-feedback">
                <span v-if="errors.has('{{ $name }}')" v-cloak>@{{ errors.first('{{{ $name }}}') }}</span>
                <span v-else>{{ $errors->first($name) }}</span>
            </div>
        @else
            <div class="invalid-feedback" v-if="errors.has('{{ $name }}')">
                @{{ errors.first('{{{ $name }}}') }}
            </div>
        @endif

        @if(isset($description))
            <small class="form-text text-muted">
                {{ $description }}
            </small>
        @endif
    </div>
</div>

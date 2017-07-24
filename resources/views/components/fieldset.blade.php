<div class="form-group row{{ $errors->has($name) ? ' has-danger' : '' }}" :class="{'has-danger': errors.has('{{ $name }}') }">
    @isset($title)
    {{ Form::label($name, isset($required) && $required ? "$title *" : $title, ['class' => isset($horizontal) && $horizontal ? "col-md-{$label_cols} col-form-label" : 'col-12 form-control-label']) }}
    @endisset

    <div class="{{ isset($horizontal) && $horizontal ? 'col-md-' . (12 - $label_cols ) : 'col-12' }}">

        {{{ $slot }}}

        @if ($errors->has($name))
            <div class="form-control-feedback" v-show="!errors.has('{{ $name }}')">
                {{ $errors->first($name) }}
            </div>
        @endif
        <div class="form-control-feedback" v-show="errors.has('{{ $name }}')" v-cloak>
            @{{ errors.first('{{{ $name }}}') }}
        </div>
        @if(isset($description))
            <p class="form-text text-muted" v-show="!errors.has('{{ $name }}')">
                {{ $description }}
            </p>
        @endif
    </div>
</div>

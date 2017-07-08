@if($form_group)
<div class="form-group{{ isset($field_wrapper_class) ? ' row' : '' }}{{ $errors->has($name) ? ' has-danger' : '' }}" :class="{'has-danger': errors.has('{{ $name }}') }">
    @isset($title)
        {{ Form::label($name, isset($required) && $required ? "$title *" : $title, ['class' =>  isset($label_col_class) ? "{$label_col_class} text-right col-form-label" : 'form-control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
        <div class="{{ $field_wrapper_class }}">
            @endif

            @include("components.form.{$field}", $parameters)
            @include('partials.help')

            @if (isset($field_wrapper_class))
        </div>
    @endif
</div>
@else
@include("components.form.{$field}", $parameters)
@include('partials.help')
@endif

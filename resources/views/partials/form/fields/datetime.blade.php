@if(!isset($attributes))
    @php($attributes = [])
@endif
@if (isset($required) && $required)
    @php($attributes += ['required'])
@endif
@if (isset($tooltip))
    @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
@endif

<div class="input-group" data-toggle="datetimepicker" data-date-format="{{ $format }}">
    {{ Form::text($name, isset($value) ? $value : null, ['id' => $name, 'class' => isset($field_class) ? "$field_class form-control text-right" : 'form-control text-right', 'placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
</div>
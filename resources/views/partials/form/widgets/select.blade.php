@if(!isset($attributes))
    @php($attributes = [])
@endif
@if (isset($tooltip))
    @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
@endif

{{ Form::select($name, $options, null, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}

@if(!isset($attributes))
    @php($attributes = [])
@endif
@if (isset($required) && $required)
    @php($attributes += ['required'])
@endif
@if (isset($tooltip))
    @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
@endif

@if ($type === 'select2')
    @php($attributes += [
        'data-toggle' => $type
    ])
@endif

@if ($type === 'autocomplete')
    @php($attributes += [
        'data-toggle' => $type,
        'data-ajax-url' => $ajax_url,
        'data-minimum-input-length' => $minimum_input_length,
        'data-item-value' => $item_value,
        'data-item-label' => $item_label
    ])
@endif

@if(isset($multiple) && $multiple)
    @php($attributes += [
        'multiple' => true,
    ])
@else
    @php($attributes += [
        'placeholder' => isset($placeholder) ? $placeholder : $title
    ])
@endif

{{ Form::select($name, $options, null, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'data-placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}

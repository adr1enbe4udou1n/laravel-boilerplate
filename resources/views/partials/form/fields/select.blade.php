@if(!isset($attributes))
    @php($attributes = [])
@endif
@if (isset($required))
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
    @if(!isset($ajax_query))
        @php($ajax_query = [])
    @endif
    @php($attributes += [
        'data-toggle' => $type,
        'data-ajax-url' => $ajax_url,
        'data-ajax-query' => json_encode((object) $ajax_query),
        'data-minimum-input-length' => $minimum_input_length,
        'data-item-value' => $item_value,
        'data-item-label' => $item_label
    ])
@endif

@if(isset($multiple))
    @php($attributes += ['multiple' => $multiple])
@endif

{{ Form::select($name, $options, null, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}

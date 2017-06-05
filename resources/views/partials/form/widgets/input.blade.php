@if(!isset($attributes))
    @php($attributes = [])
@endif
@if (isset($required))
    @php($attributes += ['required'])
    @php($rules = isset($rules) ? "required|$rules" : 'required')
@endif
@if (isset($rules))
    @php($attributes += ['v-validate' => "'$rules'"])
@endif
@if (isset($tooltip))
    @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
@endif

@if (isset($input_group_prefix) || isset($input_group_suffix))
<div class="input-group">
@endif
    @if (isset($input_group_prefix))
    <span class="input-group-addon">{!! $input_group_prefix !!}</span>
    @endif
    @if ($type === 'password')
        {{ Form::password($name, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => '************'] + $attributes) }}
    @else
        {{ Form::$type($name, null, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}
    @endif
    @if (isset($feedback_class))
    <span class="{{ $feedback_class }} form-control-feedback"></span>
    @endif
    @if (isset($input_group_suffix))
    <span class="input-group-addon">{!! $input_group_suffix !!}</span>
    @endif
@if (isset($input_group_prefix) || isset($input_group_suffix))
</div>
@endif
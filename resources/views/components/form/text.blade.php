@component('components.form-group', $parameters)
    @if (isset($input_group_prefix) || isset($input_group_suffix))
        <div class="input-group" @isset($input_group_attributes){!! Html::attributes($input_group_attributes) !!}@endisset>
            @endif
            @if (isset($input_group_prefix))
                <span class="input-group-addon">{!! $input_group_prefix !!}</span>
            @endif
            {{ Form::$type($name, isset($value) ? $value : null, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
            @if (isset($feedback_class))
                <span class="{{ $feedback_class }} form-control-feedback"></span>
            @endif
            @if (isset($input_group_suffix))
                <span class="input-group-addon">{!! $input_group_suffix !!}</span>
            @endif
            @if (isset($input_group_prefix) || isset($input_group_suffix))
        </div>
    @endif
@endcomponent
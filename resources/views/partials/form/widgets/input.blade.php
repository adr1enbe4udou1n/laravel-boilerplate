@component('partials.form.group', ['name' => $name])
    @isset($title)
    {{ Form::label($name, $title, ['class' =>  isset($label_class) ? "$label_class control-label" : 'control-label']) }}
    @endisset

    @if (isset($field_wrapper_class))
    <div class="{{ $field_wrapper_class }}">
    @endif

        @if (isset($input_group_prefix) || isset($input_group_suffix))
        <div class="input-group">
        @endif
            @if (isset($input_group_prefix))
            <span class="input-group-addon">{!! $input_group_prefix !!}</span>
            @endif
            @if(!isset($attributes))
                @php($attributes = [])
            @endif
            @if (isset($tooltip))
                @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
            @endif
            @if ($type === 'password')
                {{ Form::password($name, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => '************'] + $attributes) }}
            @else
                {{ Form::$type($name, null, ['class' => isset($field_class) ? "$field_class form-control" : 'form-control', 'placeholder' => isset($placeholder) ? $placeholder : $title] + $attributes) }}
            @endif
            @if (isset($input_group_suffix))
            <span class="input-group-addon">{!! $input_group_suffix !!}</span>
            @endif
        @if (isset($input_group_prefix) || isset($input_group_suffix))
        </div>
        @endif

        @include('partials.form.help')
    @if (isset($field_wrapper_class))
    </div>
    @endif
@endcomponent
@foreach($choices as $key => $choice)
    @if(is_string($choice))
        @php($value = $key)
        @php($label = $choice)
    @elseif(is_array($choice))
        @php($value = isset($choice_value) ? $choice[$choice_value] : $key)
        @php($label = isset($choice_label) ? $choice[$choice_label] : $key)
    @else
        @php($value = isset($choice_value) ? $choice->$choice_value : $choice->id)
        @php($label = isset($choice_label) ? $choice->$choice_label : $choice->__toString())
    @endif
    <div class="checkbox icheck">
        @if(isset($choice_tooltip))
            @if(is_string($choice))
                @php($description = $choice)
            @elseif(is_array($choice))
                @php($description = $choice[$choice_tooltip['title']])
            @else
                @php($description = $choice->{$choice_tooltip['title']})
            @endif
            <label data-toggle="tooltip" data-placement="{{ $choice_tooltip['position'] }}"
                   title="{{ trans($description) }}">
            @else
            <label>
            @endif
                @if($type === 'checkboxes')
                    @php($type = 'checkbox')
                @endif
                @if($type === 'radios')
                    @php($type = 'radio')
                @endif

                {{ Form::$type($multiple ? "{$name}[]" : $name, $value, null, $attributes) }} {{ trans($label) }}
            </label>
    </div>
@endforeach
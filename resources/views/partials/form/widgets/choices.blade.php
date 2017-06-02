@foreach($choices as $key => $choice)
    @if(is_array($choice))
        @php($value = isset($choice_value) ? $choice[$choice_value] : $key)
        @php($label = isset($choice_label) ? $choice[$choice_label] : $key)
    @else
        @php($value = isset($choice_value) ? $choice->$choice_value : $choice->id)
        @php($label = isset($choice_label) ? $choice->$choice_label : $choice->__toString())
    @endif
    <div class="checkbox icheck">
        @if(isset($choice_tooltip))
            <label data-toggle="tooltip" data-placement="{{ $choice_tooltip['position'] }}" title="{{ trans(is_array($choice) ? $choice[$choice_tooltip['title']] : $choice->$choice_tooltip['title']) }}">
        @else
            <label>
        @endif
            {{ Form::$type($type === 'radio' ? $name : $name.'[]', $value) }} {{ trans($label) }}
        </label>
    </div>
@endforeach

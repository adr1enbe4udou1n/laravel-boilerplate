@if(isset($stacked) && $stacked)
<div class="custom-controls-stacked">
@endif
@foreach($choices as $key => $choice)
    @if(is_string($choice))
        @php
            $value = $key;
            $label = $choice;
        @endphp
    @elseif(is_array($choice))
        @php
            $value = isset($choice_value) ? $choice[$choice_value] : $key;
            $label = isset($choice_label) ? $choice[$choice_label] : $key;
        @endphp
    @else
        @php
            $value = isset($choice_value) ? $choice->$choice_value : $choice->id;
            $label = isset($choice_label) ? $choice->$choice_label : $choice->__toString();
        @endphp
    @endif
    @if(isset($choice_tooltip))
        @if(is_string($choice))
            @php
                $description = $choice;
            @endphp
        @elseif(is_array($choice))
            @php
                $description = $choice[$choice_tooltip['title']];
            @endphp
        @else
            @php
                $description = $choice->{$choice_tooltip['title']};
            @endphp
        @endif
        @php
            $label_attributes = [
                'data-toggle' => 'tooltip',
                'data-placement' => $choice_tooltip['position'],
                'title' => trans($description)
            ];
        @endphp
    @endif
    <label class="custom-control custom-{{ $type }}" {!! Html::attributes($label_attributes ?? []) !!}>
        {{ Form::$type($multiple ? "{$name}[]" : $name, $value, null, array_merge(['class' => 'custom-control-input'], $attributes)) }}
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">{{ trans($label) }}</span>
    </label>
@endforeach
@if(isset($stacked) && $stacked)
</div>
@endif
<div class="input-group" data-toggle="datetimepicker" data-date-format="{{ $format }}">
    {{ Form::text($name, isset($value) ? $value : null, array_merge(['id' => $name, 'class' => 'form-control text-right'], $attributes)) }}
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
</div>
@if ($errors->has($name))
    <span class="help-block">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@elseif(isset($description))
    <span class="help-block">
        <strong>{{ $description }}</strong>
    </span>
@endif
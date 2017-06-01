@if ($errors->has($name))
    <span class="help-block">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@endif
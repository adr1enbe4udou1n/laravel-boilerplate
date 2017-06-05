@if ($errors->has($name))
    <span class="help-block" v-show="!errors.has('{{ $name }}')">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@elseif(isset($description))
    <span class="help-block" v-show="errors.has('{{ $name }}')">
        <strong>{{ $description }}</strong>
    </span>
@endif

<span v-show="errors.has('{{ $name }}')" class="help-block" v-cloak>
    <strong>@{{ errors.first('{{{ $name }}}') }}</strong>
</span>

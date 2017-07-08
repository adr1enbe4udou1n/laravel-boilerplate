@if ($errors->has($name))
    <div class="form-control-feedback" v-show="!errors.has('{{ $name }}')">
        {{ $errors->first($name) }}
    </div>
@endif
<div class="form-control-feedback" v-show="errors.has('{{ $name }}')" v-cloak>
    @{{ errors.first('{{{ $name }}}') }}
</div>
@if(isset($description))
    <p class="form-text text-muted" v-show="!errors.has('{{ $name }}')">
        {{ $description }}
    </p>
@endif

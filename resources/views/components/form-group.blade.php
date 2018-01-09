<div class="form-group @if(isset($horizontal) && $horizontal)row @endif">
    @isset($title)
    <label for="{{ $name }}" @if(isset($horizontal) && $horizontal)class="col-md-{{ $label_cols }} col-form-label" @endif>{{ $title }}</label>
    @endisset

    @if(isset($horizontal) && $horizontal)
    <div class="col-md-{{ (12 - $label_cols) }}">
    @endif

        {{{ $slot }}}

        @if ($errors->has($name))
        <div class="invalid-feedback">
            <span v-if="errors.has('{{ $name }}')" v-cloak>@{{ errors.first('{{{ $name }}}') }}</span>
            <span v-else>{{ $errors->first($name) }}</span>
        </div>
        @else
        <div class="invalid-feedback" v-if="errors.has('{{ $name }}')">
            @{{ errors.first('{{{ $name }}}') }}
        </div>
        @endif

        @if(isset($description))
        <small class="form-text text-muted">
            {{ $description }}
        </small>
        @endif

    @if(isset($horizontal) && $horizontal)
    </div>
    @endif
</div>

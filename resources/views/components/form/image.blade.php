<div class="media">
    @if(isset($url) && $url)
        <img class="mr-2" src="{{ image_template_url('small', $url) }}" alt="">
    @endif
    <div class="media-body">
        <h4>@lang('labels.upload_image')</h4>
        {{ Form::file($name, array_merge(['id' => $name, 'class' => "form-control $field_class"], $attributes)) }}
        <p class="form-text text-muted" v-show="!errors.has('{{ $name }}')">
            @lang('labels.descriptions.allowed_image_types')
        </p>
    </div>
</div>
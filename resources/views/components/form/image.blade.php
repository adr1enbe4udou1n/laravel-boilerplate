<div class="media">
    @if(isset($url) && $url)
        <div class="media-left">
            <img class="media-object" src="{{ image_template_url('small', $url) }}" alt="">
        </div>
    @endif
    <div class="media-body">
        <h4 class="media-heading">@lang('labels.upload_image')</h4>
        {{ Form::file($name, array_merge(['id' => $name, 'class' => 'form-control'], $attributes)) }}
        <span class="help-block">
        @lang('labels.descriptions.allowed_image_types')
    </span>
    </div>
</div>
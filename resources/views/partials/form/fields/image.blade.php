<div class="media">
    @if(isset($url) && $url)
    <div class="media-left">
        <img class="media-object" src="{{ image_template_url('small', $url) }}" alt="">
    </div>
    @endif
    <div class="media-body">
        <h4 class="media-heading">@lang('labels.select_image')</h4>
        @include('partials.form.fields.file')
    </div><!--media-body-->
</div><!--media-->

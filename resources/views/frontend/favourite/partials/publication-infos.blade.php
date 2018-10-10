@if ((isset($hide_owner) && $hide_owner) || !config('blog.show_post_owner'))
    @lang('labels.frontend.blog.published_at', ['date' => $post->updated_at->formatLocalized('%A %d %B %Y')])
@else
    {!!
        __('labels.frontend.blog.published_at_with_owner_linkable', [
            'date' => $post->updated_at->formatLocalized('%A %d %B %Y'),
            'name' => $post->owner,
            'link' => route('blog.owner', $post->owner->slug),
        ])
    !!}
@endif

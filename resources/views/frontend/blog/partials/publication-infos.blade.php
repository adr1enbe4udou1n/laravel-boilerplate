@if ((isset($hide_owner) && $hide_owner) || !config('blog.show_post_owner'))
    @lang('labels.frontend.blog.published_at', ['date' => $post->published_at->formatLocalized('%A %d %B %Y')])
@else
    @lang('labels.frontend.blog.published_at_with_owner_linkable', [
        'date' => $post->published_at->formatLocalized('%A %d %B %Y'),
        'name' => $post->owner,
        'link' => route('blog.owner', $post->owner->slug),
    ])
@endif
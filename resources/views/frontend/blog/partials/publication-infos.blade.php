@if ((isset($hide_owner) && $hide_owner) || !config('blog.show_post_owner'))
    @lang('labels.frontend.blog.published_at', ['date' => $post->published_at->formatLocalized('%A %d %B %Y')])
@else
    @if (config('account.show_user_profile'))
        @lang('labels.frontend.blog.published_at_with_owner_linkable', [
            'date' => $post->published_at->formatLocalized('%A %d %B %Y'),
            'name' => $post->owner,
            'link' => route('user.show', $post->owner->slug),
        ])
    @else
        @lang('labels.frontend.blog.published_at_with_owner', [
            'date' => $post->published_at->formatLocalized('%A %d %B %Y'),
            'name' => $post->owner,
        ])
    @endif
@endif
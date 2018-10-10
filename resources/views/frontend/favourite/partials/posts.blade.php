@if(!empty($items))
    @foreach($items->chunk(3) as $chunk)
        <div class="row">
            @foreach($chunk as $post)
                <div class="col-md-4 mb-4">
                    <article class="article">
                        <a href="{{ route('blog.show', ['post' => $post->slug]) }}" class="article__cover">
                            <img src="{{ image_template_url('large', $post->featured_image_path) }}" alt="{{ $post->title }}">
                        </a>
                        <div class="article__infos">
                            <h5 class="article__title">
                                <a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
                            </h5>
                            <p class="article__published">
                                @include('frontend.favourite.partials.publication-infos')
                            </p>
                            <p class="article__summary">
                                {{ $post->summary }}
                            </p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    @endforeach
@endif

<div class="row justify-content-center">
    {{ $items->links() }}
</div>

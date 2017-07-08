@if(!empty($posts))
    @foreach($posts->chunk(2) as $chunk)
        <div class="row">
            @foreach($chunk as $post)
                <div class="col-md-6">
                    <div class="media">
                        <a href="{{ route('blog.show', ['post' => $post->slug]) }}" class="mr-3">
                            <img class="media-object" src="{{ image_template_url('small', $post->featured_image_url) }}" alt="{{ $post->title }}">
                        </a>
                        <div class="media-body">
                            <h5 class="mt-0">
                                <a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
                            </h5>

                            {{ $post->summary }}

                            <small>
                                @include('frontend.blog.partials.publication-infos')
                            </small>
                        </div><!--media-body-->
                    </div><!--media-->
                </div>
            @endforeach
        </div>
    @endforeach
@endif

<div class="row justify-content-center">
    {{ $posts->links() }}
</div>
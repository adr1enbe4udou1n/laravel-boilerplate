@if(!empty($posts))
    @foreach($posts->chunk(2) as $chunk)
        <div class="row">
            @foreach($chunk as $post)
                <div class="col-md-6">
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ route('blog.show', ['post' => $post->slug]) }}">
                                <img class="media-object" src="{{ image_template_url('small', $post->featured_image_url) }}" alt="{{ $post->title }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
                                <small>
                                    @include('frontend.blog.partials.publication-infos')
                                </small>
                            </h4>

                            <p>{{ $post->summary }}</p>
                        </div><!--media-body-->
                    </div><!--media-->
                </div>
            @endforeach
        </div>
    @endforeach
@endif

<div class="text-center">
    {{ $posts->links() }}
</div>
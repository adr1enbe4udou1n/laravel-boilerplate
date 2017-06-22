<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Contracts\PostRepository;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogController extends FrontendController
{
    /**
     * @var PostRepository
     */
    protected $posts;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Contracts\PostRepository $posts
     */
    public function __construct(PostRepository $posts)
    {
        parent::__construct();

        $this->posts = $posts;
    }

    public function index()
    {
        return view('frontend.blog.index')->withPosts(
            $this->posts->published()->paginate(10)
        );
    }

    public function tag(Tag $tag)
    {
        return view('frontend.blog.tag')->withTag($tag)->withPosts(
            $this->posts->publishedByTag($tag)->paginate(10)
        );
    }

    public function owner(User $user)
    {
        $this->setLocalesAttributes(['user' => $user->slug]);

        return view('frontend.blog.owner')
            ->withUser($user)
            ->withPosts($this->posts->publishedByOwner($user)->paginate(10));
    }

    public function show(Post $post)
    {
        $this->setTranslatable($post);

        return view('frontend.blog.show')->withPost($post);
    }
}

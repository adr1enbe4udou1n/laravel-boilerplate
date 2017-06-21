<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Contracts\PostRepository;

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
        return view('frontend.blog.index')->withPosts($this->posts->published()->paginate(10));
    }

    public function show($post)
    {
        $this->setTranslatable($post);

        return view('frontend.blog.show')->withPost($post);
    }
}

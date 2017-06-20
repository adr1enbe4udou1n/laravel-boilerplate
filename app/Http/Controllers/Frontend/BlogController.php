<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Contracts\PostRepository;
use App\Http\Controllers\Controller;

class BlogController extends Controller
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
        $this->posts = $posts;
    }

    public function index()
    {
        return view('frontend.blog.index')->withPosts($this->posts->published()->paginate(10));
    }

    public function show($post)
    {
        return view('frontend.blog.show')->withPost($post);
    }
}

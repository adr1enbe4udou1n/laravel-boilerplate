<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
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

    public function index() {
        return view('frontend.blog.index');
    }

    public function show(Post $post) {
        return view('frontend.blog.index');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Repositories\Contracts\PostRepository;

class UserController extends FrontendController
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

    public function show(User $user)
    {
        return view('frontend.user.show')->withUser($user)->withPosts(
            $this->posts->publishedByOwner($user)->paginate(10)
        );
    }
}

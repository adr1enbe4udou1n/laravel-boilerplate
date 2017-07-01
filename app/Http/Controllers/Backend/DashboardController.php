<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Repositories\Contracts\FormSubmissionRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends BackendController
{

    /**
     * @var \App\Repositories\Contracts\PostRepository
     */
    protected $posts;

    /**
     * @var \App\Repositories\Contracts\UserRepository
     */
    protected $users;

    /**
     * @var \App\Repositories\Contracts\FormSubmissionRepository
     */
    protected $formSubmissions;

    /**
     * DashboardController constructor.
     *
     * @param \App\Repositories\Contracts\PostRepository           $posts
     * @param \App\Repositories\Contracts\UserRepository           $users
     * @param \App\Repositories\Contracts\FormSubmissionRepository $formSubmissions
     * @param \Illuminate\Contracts\View\Factory                   $view
     */
    public function __construct(
        PostRepository $posts,
        UserRepository $users,
        FormSubmissionRepository $formSubmissions,
        Factory $view
    ) {
        parent::__construct($view);

        $this->posts = $posts;
        $this->users = $users;
        $this->formSubmissions = $formSubmissions;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $new_posts_count = $this->posts->query()->whereStatus(Post::DRAFT)->count();
        $pending_posts_count = $this->posts->query()->whereStatus(Post::PENDING)->count();
        $published_posts_count = $this->posts->query()->whereStatus(Post::PUBLISHED)->count();
        $active_users_count = $this->users->query()->whereActive(true)->count();
        $form_submissions_count = $this->formSubmissions->query()->count();
        $posts = $this->posts->query()->orderByDesc('created_at')->limit(10)->get();

        return view('backend.home',
            compact('new_posts_count', 'pending_posts_count',
                'published_posts_count', 'active_users_count',
                'form_submissions_count', 'posts'));
    }
}

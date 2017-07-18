<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BackendController extends Controller
{
    public function __construct(Factory $view)
    {
        $view->composer('backend.partials.sidebar', function (View $view) {
            $posts = app(PostRepository::class)->make();

            $view->with('new_posts_count', $posts->whereStatus(Post::DRAFT)->count());
            $view->with('pending_posts_count', $posts->whereStatus(Post::PENDING)->count());
        });
    }

    protected function RedirectResponse(Request $request, $message, $type = 'success')
    {
        if ($request->wantsJson()) {
            return response()->json([
              'status' => $type,
              'message' => $message,
            ]);
        }

        return redirect()->back()->with("flash_{$type}", $message);
    }
}

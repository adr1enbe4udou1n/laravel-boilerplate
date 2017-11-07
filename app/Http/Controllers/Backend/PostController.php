<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\Contracts\PostRepository;

class PostController extends BackendController
{
    /**
     * @var PostRepository
     */
    protected $posts;

    /**
     * @var TagRepository
     */
    protected $tags;

    /**
     * Create a new controller instance.
     *
     *
     * @param \App\Repositories\Contracts\PostRepository $posts
     * @param \App\Repositories\Contracts\TagRepository  $tags
     */
    public function __construct(PostRepository $posts, TagRepository $tags)
    {
        $this->posts = $posts;
        $this->tags = $tags;
    }

    public function getDraftPostCounter()
    {
        return $this->posts->query()->whereStatus(Post::DRAFT)->count();
    }

    public function getPendingPostCounter()
    {
        return $this->posts->query()->whereStatus(Post::PENDING)->count();
    }

    public function getPublishedPostCounter()
    {
        return $this->posts->query()->whereStatus(Post::PUBLISHED)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLastestPosts()
    {
        $query = $this->posts->query();

        if (! Gate::check('view posts')) {
            // Filter to only current user's posts
            $query->whereUserId(auth()->id());
        }

        return $query->orderByDesc('created_at')->limit(10)->get();
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Builder $query */
            $query = $this->posts->select([
                'id',
                'user_id',
                'status',
                'pinned',
                'promoted',
                'created_at',
                'updated_at',
            ]);

            if (! Gate::check('view posts')) {
                // Filter to only current user's posts
                $query->whereUserId(auth()->id());
            }

            /** @var \Yajra\DataTables\EloquentDataTable $query */
            $query = DataTables::of($query);

            return $query->addColumn('actions', function (Post $post) {
                return $this->posts->getActionButtons($post);
            })->addColumn('image', function (Post $post) {
                $url = image_template_url('small', $post->featured_image_path);

                return "<a href=\"/posts/{$post->id}/edit\" data-router-link>"
                    ."<img src=\"$url\" alt=\"{$post->title}\"></a>";
            })->editColumn('title', function (Post $post) {
                return "<a href=\"/posts/{$post->id}/edit\" data-router-link>{$post->title}</a>";
            })->editColumn('status', function (Post $post) {
                return state_html_label($post->state, __($post->status_label));
            })->editColumn('pinned', function (Post $post) {
                return boolean_html_label($post->pinned);
            })->editColumn('promoted', function (Post $post) {
                return boolean_html_label($post->promoted);
            })->editColumn('created_at', function (Post $post) use ($request) {
                return $post->created_at->setTimezone($request->user()->timezone);
            })->editColumn('updated_at', function (Post $post) use ($request) {
                return $post->updated_at->setTimezone($request->user()->timezone);
            })
                ->rawColumns(['image', 'title', 'status', 'pinned', 'promoted', 'actions'])
                ->make(true);
        }
    }

    /**
     * @param Post $post
     *
     * @return Post
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $post->tags = $post->tags()->pluck('name');

        return $post;
    }

    /**
     * @param StorePostRequest $request
     *
     * @return mixed
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize('create posts');

        /** @var Post $post */
        $post = $this->posts->make(
            $request->only('title', 'summary', 'body', 'published_at', 'unpublished_at', 'pinned', 'promoted')
        );

        if ('publish' === $request->input('status')) {
            $this->posts->saveAndPublish($post, $request->input(), $request->file('featured_image'));
        } else {
            $this->posts->saveAsDraft($post, $request->input(), $request->file('featured_image'));
        }

        return $this->RedirectResponse($request, __('alerts.backend.posts.created'));
    }

    /**
     * @param Post              $post
     * @param UpdatePostRequest $request
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     *
     * @return mixed
     */
    public function update(Post $post, UpdatePostRequest $request)
    {
        $this->authorize('update', $post);

        $post->fill(
            $request->only('title', 'summary', 'body', 'published_at', 'unpublished_at', 'pinned', 'promoted')
        );

        if ('publish' === $request->input('status')) {
            $this->posts->saveAndPublish($post, $request->input(), $request->file('featured_image'));
        } else {
            $this->posts->saveAsDraft($post, $request->input(), $request->file('featured_image'));
        }

        return $this->RedirectResponse($request, __('alerts.backend.posts.updated'));
    }

    /**
     * @param Post    $post
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete', $post);

        $this->posts->destroy($post);

        return $this->RedirectResponse($request, __('alerts.backend.posts.deleted'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function batchAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');

        switch ($action) {
            case 'destroy':
                $this->authorize('delete posts');

                $this->posts->batchDestroy($ids);

                return $this->RedirectResponse($request, __('alerts.backend.posts.bulk_destroyed'));
                break;
            case 'publish':
                $this->authorize('edit posts');

                $this->posts->batchPublish($ids);

                if (Gate::check('publish posts')) {
                    return $this->RedirectResponse($request, __('alerts.backend.posts.bulk_published'));
                }

                return $this->RedirectResponse($request, __('alerts.backend.posts.bulk_pending', 'warning'));
                break;
            case 'pin':
                $this->authorize('edit posts');

                $this->posts->batchPin($ids);

                return $this->RedirectResponse($request, __('alerts.backend.posts.bulk_pinned'));
                break;
            case 'promote':
                $this->authorize('edit posts');

                $this->posts->batchPromote($ids);

                return $this->RedirectResponse($request, __('alerts.backend.posts.bulk_promoted'));
                break;
        }

        return $this->RedirectResponse($request, __('alerts.backend.actions.invalid'), 'error');
    }
}

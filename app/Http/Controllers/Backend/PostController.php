<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Engines\EloquentEngine;
use Yajra\Datatables\Facades\Datatables;

class PostController extends BackendController
{
    /**
     * @var PostRepository
     */
    protected $posts;

    /**
     * Create a new controller instance.
     *
     *
     * @param \App\Repositories\Contracts\PostRepository $posts
     */
    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.post.index');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var EloquentEngine $query */
            $query = Datatables::of($this->posts->select([
                'id',
                'status',
                'pinned',
                'promoted',
                'published_at',
                'created_at',
                'updated_at',
            ]));

            return $query->addColumn('actions', function (Post $post) {
                return $this->posts->getActionButtons($post);
            })->addColumn('image', function (Post $post) {
                return link_to(
                    route('admin.post.edit', $post),
                    image_template_html('small', $post->featured_image_url, $post->title),
                    [], null, false
                );
            })->editColumn('title', function (Post $post) {
                return link_to_route('admin.post.edit', $post->title, $post);
            })->editColumn('status', function (Post $post) {
                return state_html_label($post->state, trans($post->status_label));
            })->editColumn('pinned', function (Post $post) {
                return boolean_html_label($post->pinned);
            })->editColumn('promoted', function (Post $post) {
                return boolean_html_label($post->promoted);
            })->editColumn('published_at', function (Post $post) use ($request) {
                return $post->published_at->setTimezone($request->user()->timezone);
            })->editColumn('created_at', function (Post $post) use ($request) {
                return $post->created_at->setTimezone($request->user()->timezone);
            })->editColumn('updated_at', function (Post $post) use ($request) {
                return $post->updated_at->setTimezone($request->user()->timezone);
            })
                ->rawColumns(['image', 'actions'])
                ->make(true);
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * @param StorePostRequest $request
     *
     * @return mixed
     */
    public function store(StorePostRequest $request)
    {
        $this->posts->store($request->input());

        return redirect()->route('admin.post.index')->withFlashSuccess(trans('alerts.backend.posts.created'));
    }

    /**
     * @param Post $post
     *
     * @return mixed
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit')->withPost($post);
    }

    /**
     * @param Post              $post
     * @param UpdatePostRequest $request
     *
     * @return mixed
     */
    public function update(Post $post, UpdatePostRequest $request)
    {
        $this->posts->update($post, $request->input());

        return redirect()->route('admin.post.index')->withFlashSuccess(trans('alerts.backend.posts.updated'));
    }

    /**
     * @param Post    $post
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Post $post, Request $request)
    {
        $this->posts->destroy($post);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.posts.deleted'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function batchAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');

        switch ($action) {
            case 'destroy':
                $this->posts->batchDestroy($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.posts.bulk_destroyed'));
                break;
            case 'published':
                $this->posts->batchPublish($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.posts.bulk_published'));
                break;
            case 'pinned':
                $this->posts->batchPin($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.posts.bulk_pinned'));
                break;
            case 'promoted':
                $this->posts->batchPromote($ids);

                return redirect()->back()->withFlashSuccess(trans('alerts.backend.posts.bulk_promoted'));
                break;
        }

        return redirect()->back()->withFlashError(trans('alerts.backend.actions.invalid'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Mcamara\LaravelLocalization\LaravelLocalization;

class AjaxController extends Controller
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
     * @var LaravelLocalization
     */
    protected $localization;

    /**
     * AjaxController constructor.
     *
     * @param \App\Repositories\Contracts\PostRepository       $posts
     * @param \App\Repositories\Contracts\TagRepository        $tags
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     */
    public function __construct(PostRepository $posts, TagRepository $tags, LaravelLocalization $localization)
    {
        $this->posts = $posts;
        $this->tags = $tags;
        $this->localization = $localization;
    }

    /**
     * Global index search.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        return empty($query) ? [] : $this->posts->search($query)->take(50)->get();
    }

    /**
     * Search internal transatables routes.
     *
     * @param Request $request
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function routesSearch(Request $request)
    {
        $query = $request->get('q');

        $items = [];

        $routes = __('routes');

        foreach ($routes as $name => $uri) {
            /* @var Route $route */
            if (str_contains($name, $query)
                || str_contains($uri, $query)
            ) {
                $items[] = [
                  'value' => $name,
                  'label' => $uri,
                ];
            }
        }

        return [
            'items' => $items,
        ];
    }

    /**
     * Search tags.
     *
     * @param Request $request
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function tagsSearch(Request $request)
    {
        $query = $request->get('q');
        $tags = $this->tags->query()
            ->whereLocale($this->localization->getCurrentLocale())
            ->where('name', 'like', "%$query%")
            ->pluck('name');

        return [
            'items' => $tags,
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function imageUpload(Request $request)
    {
        /** @var \Illuminate\Http\UploadedFile $uploadedImage */
        $uploadedImage = $request->file('upload');

        // Resize image below 600px width if needed
        $image = Image::make($uploadedImage->openFile())->widen(600, function ($constraint) {
            $constraint->upsize();
        });

        $imageName = Str::random(32);
        $imagePath = "editor/{$imageName}.{$uploadedImage->extension()}";

        Storage::disk('public')->put($imagePath, $image->stream());

        return [
            'uploaded' => true,
            'url' => "/storage/$imagePath",
            'width' => $image->width(),
            'height' => $image->height(),
        ];
    }
}

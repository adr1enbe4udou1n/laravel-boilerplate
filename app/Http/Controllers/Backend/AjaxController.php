<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Mcamara\LaravelLocalization\LaravelLocalization;

class AjaxController extends Controller
{

    /**
     * @var \App\Repositories\Contracts\TagRepository
     */
    protected $tags;

    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * AjaxController constructor.
     *
     * @param \App\Repositories\Contracts\TagRepository        $tags
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     */
    public function __construct(TagRepository $tags, LaravelLocalization $localization)
    {
        $this->tags = $tags;
        $this->localization = $localization;
    }

    /**
     * Search internal transatables routes.
     *
     * @param Request $request
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function routesSearch(Request $request)
    {
        $query = $request->get('q');

        $items = [];

        $routes = trans('routes');

        foreach ($routes as $name => $uri) {
            /* @var Route $route */
            if (str_contains($name, $query)
                || str_contains($uri, $query)
            ) {
                $items[] = [
                    'name' => $name,
                    'uri' => $uri,
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
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function tagsSearch(Request $request)
    {
        $query = $request->get('q');
        $tags = $this->tags->query()
            ->whereLocale($this->localization->getCurrentLocale())
            ->where('name', 'like', "%$query%")
            ->get();

        return [
            'items' => $tags,
        ];
    }
}

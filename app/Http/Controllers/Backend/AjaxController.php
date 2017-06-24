<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class AjaxController extends Controller
{

    /**
     * @var \App\Repositories\Contracts\TagRepository
     */
    protected $tags;

    /**
     * AjaxController constructor.
     *
     * @param \App\Repositories\Contracts\TagRepository $tags
     */
    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
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
        //$tags = $this->tags->query()->whereLocal

        return [
            'items' => [

            ],
        ];
    }
}

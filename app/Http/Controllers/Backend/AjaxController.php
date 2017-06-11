<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class AjaxController extends Controller
{
    /**
     * Search internal transatables routes.
     *
     * @param Request $request
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function routeSearch(Request $request)
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
}

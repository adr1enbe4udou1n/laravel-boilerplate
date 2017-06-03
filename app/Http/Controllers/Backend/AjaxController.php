<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

class AjaxController extends Controller
{
    /**
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * AjaxController constructor.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Search internal routes.
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
        $middlware = $request->get('middleware');

        $items = [];

        $routes = $this->router->getRoutes();

        foreach ($routes as $route) {
            /** @var Route $route */
            if (str_contains($route->getName(), $query)
                || str_contains($route->uri(), $query)
            ) {
                $action = $route->getAction();

                if ($middlware
                    && !in_array($middlware, $action['middleware'], true)
                ) {
                    continue;
                }

                $items[] = [
                    'name' => $route->getName(),
                    'uri' => $route->uri(),
                ];
            }
        }

        return [
            'items' => $items
        ];
    }
}

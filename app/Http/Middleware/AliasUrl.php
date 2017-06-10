<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\MetaRepository;
use Closure;
use Illuminate\Routing\Router;

class AliasUrl
{
    /**
     * @var MetaRepository
     */
    protected $metas;

    /**
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Create a new controller instance.
     *
     * @param MetaRepository             $metas
     * @param \Illuminate\Routing\Router $router
     */
    public function __construct(MetaRepository $metas, Router $router)
    {
        $this->metas = $metas;
        $this->router = $router;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->segments();
        dd($path);
        $meta = $this->metas->findBySlug($path);

        if ($meta) {
            $routes = $this->router->getRoutes();

            $route = $routes->getByName($meta->route);

            $route->setUri($path);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\MetaRepository;
use Closure;
use Illuminate\Support\Facades\View;

class MetaTags
{

    /**
     * @var MetaRepository
     */
    protected $metas;

    /**
     * Create a new controller instance.
     *
     * @param MetaRepository $metas
     */
    public function __construct(MetaRepository $metas)
    {
        $this->metas = $metas;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentLocale = \LaravelLocalization::getCurrentLocale();
        $routeName = $request->route()->getName();

        $meta = $this->metas->find($currentLocale, $routeName);

        if ($meta) {
            View::composer('*',
                function (\Illuminate\View\View $view) use ($meta) {
                    $view->with('title', $meta->title);
                });

            View::composer('*',
                function (\Illuminate\View\View $view) use ($meta) {
                    $view->with('description', $meta->description);
                });
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\MetaRepository;
use Closure;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\LaravelLocalization;

class MetaTags
{
    /**
     * @var LaravelLocalization
     */
    protected $localization;

    /**
     * @var MetaRepository
     */
    protected $metas;

    /**
     * Create a new controller instance.
     *
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @param MetaRepository                                   $metas
     */
    public function __construct(LaravelLocalization $localization, MetaRepository $metas)
    {
        $this->localization = $localization;
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
        $currentLocale = $this->localization->getCurrentLocale();
        $routeName = $request->route()->getName();

        //$meta = $this->metas->find($currentLocale, $routeName);
        $meta = null;

        if ($meta) {
            View::composer('*',
                function (\Illuminate\View\View $view) use ($meta) {
                    $view->with('meta_title', $meta->title);
                });

            View::composer('*',
                function (\Illuminate\View\View $view) use ($meta) {
                    $view->with('meta_description', $meta->description);
                });
        }

        return $next($request);
    }
}

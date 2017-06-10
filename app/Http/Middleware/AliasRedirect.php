<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\MetaRepository;
use Closure;
use Mcamara\LaravelLocalization\LaravelLocalization;

class AliasRedirect
{
    /**
     * @var MetaRepository
     */
    protected $metas;

    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * Create a new controller instance.
     *
     * @param MetaRepository                                   $metas
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     */
    public function __construct(MetaRepository $metas, LaravelLocalization $localization)
    {
        $this->metas = $metas;
        $this->localization = $localization;
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
        $route = $request->route()->getName();
        $alias = $this->metas->find($this->localization->getCurrentLocale(), $route);

        if ($alias && !empty($alias->url) && $alias->url !== $request->getPathInfo()) {
            return redirect($alias->url);
        }

        return $next($request);
    }
}

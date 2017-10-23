<?php

namespace App\Http\Middleware;

use Closure;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Repositories\Contracts\MetaRepository;

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
        $routeName = $request->route()->getName();

        $meta = $this->metas->find($routeName);

        if ($meta) {
            SEOMeta::setTitle($meta->title);
            SEOMeta::setDescription($meta->description);
        }

        return $next($request);
    }
}

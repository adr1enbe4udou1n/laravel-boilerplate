<?php

namespace App\Http\Middleware;

use Closure;
use Lang;
use View;

class MetaTags
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();

        $metaTitle = Lang::has("metas.$routeName.title", null, false)
            ? trans("metas.$routeName.title")
            : trans('metas.default.title');
        $metaDescription = Lang::has("metas.$routeName.description", null, false)
            ? trans("metas.$routeName.description")
            : trans('metas.default.description');

        View::share('title', $metaTitle);
        View::share('description', $metaDescription);

        return $next($request);
    }
}

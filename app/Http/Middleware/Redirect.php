<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\RedirectionRepository;
use Closure;
use Mcamara\LaravelLocalization\LaravelLocalization;

class Redirect
{

    /**
     * @var RedirectionRepository
     */
    protected $redirections;

    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * Create a new controller instance.
     *
     * @param RedirectionRepository                            $redirections
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     */
    public function __construct(RedirectionRepository $redirections, LaravelLocalization $localization)
    {
        $this->redirections = $redirections;
        $this->localization = $localization;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws \Mcamara\LaravelLocalization\Exceptions\UnsupportedLocaleException
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function handle($request, Closure $next)
    {
        $redirection = $this->redirections->find($request->getPathInfo());

        if ($redirection) {
            $target = $this->localization->getURLFromRouteNameTranslated($redirection->locale, "routes.{$redirection->route}");

            return redirect($target, $redirection->type);
        }

        return $next($request);
    }
}

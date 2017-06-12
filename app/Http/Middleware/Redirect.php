<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\RedirectionRepository;
use Closure;

class Redirect
{
    /**
     * @var RedirectionRepository
     */
    protected $redirections;

    /**
     * Create a new controller instance.
     *
     * @param RedirectionRepository $redirections
     */
    public function __construct(RedirectionRepository $redirections)
    {
        $this->redirections = $redirections;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\UnsupportedLocaleException
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function handle($request, Closure $next)
    {
        $redirection = $this->redirections->find($request->getPathInfo());

        if ($redirection && $redirection->active) {
            return redirect($redirection->target, $redirection->type);
        }

        return $next($request);
    }
}

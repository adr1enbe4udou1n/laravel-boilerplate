<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Contracts\RedirectionRepository;

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
     * @throws \Mcamara\LaravelLocalization\Exceptions\UnsupportedLocaleException
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redirection = $this->redirections->find($request->getRequestUri());

        if ($redirection && $redirection->active) {
            return redirect($redirection->target, $redirection->type);
        }

        return $next($request);
    }
}

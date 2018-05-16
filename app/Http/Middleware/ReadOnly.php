<?php

namespace App\Http\Middleware;

use Closure;

class ReadOnly
{
    private $except = [
        '*/login',
    ];

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
        if ($this->isReadOnly($request)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('exceptions.unauthorized')], 403);
            }

            return redirect()->back()->withFlashError(__('exceptions.unauthorized'));
        }

        return $next($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    private function isReadOnly($request)
    {
        // Only Http Verbs different than GET are concerned
        if (! config('app.read_only') || 'GET' === $request->method()) {
            return false;
        }

        // Super admin has no limitation
        $user = auth()->user();

        if ($user && $user->is_super_admin) {
            return false;
        }

        return ! $this->inExceptArray($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ('/' !== $except) {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}

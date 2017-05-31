<?php

use Illuminate\Support\HtmlString;

if (!function_exists('assets')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string $path
     *
     * @return mixed
     *
     * @throws \Exception
     */
    function assets($path)
    {
        static $manifest;

        if (!starts_with($path, '/')) {
            $path = "/{$path}";
        }

        if (app()->environment('local', 'testing')) {
            if (file_exists(public_path('/hot'))) {
                $hmrPort = config('app.hmr_port');

                return new HtmlString("//localhost:{$hmrPort}{$path}");
            }

            if (file_exists(public_path($path))) {
                return new HtmlString($path);
            }
        }

        if (!$manifest
            && file_exists($manifestPath = public_path('/assets-manifest.json'))
        ) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if ($manifest && array_key_exists($path, $manifest)) {
            return new HtmlString($manifest[$path]);
        }

        return new HtmlString($path);
    }
}

if (!function_exists('home_route')) {

    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (Gate::allows('access backend')) {
            return route('admin.home');
        }

        return route('user.home');
    }
}

if (!function_exists('is_admin_route')) {

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    function is_admin_route(Illuminate\Http\Request $request)
    {
        $action = $request->route()->getAction();

        return ($action['namespace'] === 'App\Http\Controllers\Backend');
    }
}

if (!function_exists('boolean_html_label')) {

    /**
     * @param $boolean boolean
     *
     * @return string
     */
    function boolean_html_label($boolean)
    {
        if ($boolean) {
            return "<label class='label label-success'>".trans('labels.yes').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.no').'</label>';
    }
}

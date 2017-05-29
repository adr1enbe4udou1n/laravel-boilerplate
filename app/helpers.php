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

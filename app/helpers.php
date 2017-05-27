<?php

use Illuminate\Support\HtmlString;

if (! function_exists('assets')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return mixed
     *
     * @throws \Exception
     */
    function assets($path, $manifestDirectory = '')
    {
        static $manifest;

        if (! starts_with($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && ! starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (app()->environment('local', 'testing')) {
            if (file_exists(public_path($manifestDirectory.'/hot'))) {
                $hmrPort = config('app.hmr_port');
                return new HtmlString("//localhost:{$hmrPort}{$path}");
            }

            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        if (! $manifest) {
            if (! file_exists($manifestPath = public_path($manifestDirectory.'/assets-manifest.json'))) {
                throw new Exception('The Assets manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (! array_key_exists($path, $manifest)) {
            throw new Exception(
                "Unable to locate Assets file: {$path}. Please check your ".
                'webpack.mix.js output paths and try again.'
            );
        }

        return new HtmlString($manifestDirectory.$manifest[$path]);
    }
}

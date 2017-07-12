<?php

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

if (!function_exists('assets')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path
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

        return $action['namespace'] === 'App\Http\Controllers\Backend';
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
        return state_html_label(
            $boolean ? 'success' : 'danger',
            $boolean ? trans('labels.yes') : trans('labels.no')
        );
    }
}

if (!function_exists('state_html_label')) {
    /**
     * @param $state
     * @param $label
     *
     * @return string
     */
    function state_html_label($state, $label)
    {
        return "<span class=\"badge badge-{$state}\">{$label}</span>";
    }
}

if (!function_exists('image_template_url')) {
    /**
     * @param $template
     * @param $image_path
     *
     * @return string
     */
    function image_template_url($template, $image_path)
    {
        $image_path = str_replace(config('filesystems.disks.public.url'), '', $image_path);

        return url(config('imagecache.route')."/$template/$image_path");
    }
}

if (!function_exists('image_template_html')) {
    /**
     * @param $template
     * @param $image_path
     * @param $alt
     *
     * @return string
     */
    function image_template_html($template, $image_path, $alt = null)
    {
        $url = image_template_url($template, $image_path);

        return "<img src=\"$url\" alt=\"$alt\">";
    }
}

if (!function_exists('form_batch_action')) {
    function form_batch_action($route, $table_id, array $actions)
    {
        $options = [];
        foreach ($actions as $name => $action) {
            if (is_string($action)) {
                $options[$name] = $action;
                continue;
            }

            if ($action['active']) {
                $options[$name] = $action['title'];
            }
        }

        return view('backend.partials.form.batch-action', compact('route', 'table_id', 'options'));
    }
}

if (!function_exists('menu_item_access')) {
    function menu_item_access($route_name, $title, $icon = null, $ability = null, $ability_arguments = [], ...$active_route_patterns)
    {
        if ($ability && !\Illuminate\Support\Facades\Gate::check($ability, $ability_arguments)) {
            return null;
        }

        if ($icon) {
            $title = "<i class=\"$icon\"></i> {$title}";
        }

        $route = link_to(route($route_name), $title, [
            'class' => 'nav-link '.active_class(if_route_pattern($active_route_patterns)),
        ], null, false);

        if (!in_array($route_name, $active_route_patterns, true)) {
            $active_route_patterns[] = $route_name;
        }

        return "<li class=\"nav-item\">{$route}</li>";
    }
}

if (!function_exists('localize_url')) {
    function localize_url($locale = null, $attributes = [], Model $translatable = null)
    {
        $url = null;

        if ($translatable && method_exists($translatable, 'translate')) {
            /** @var Translatable $translatable */
            if ($translation = $translatable->translate($locale)) {
                $slug = $translation->slug;

                $url = route(Route::current()->getName(), ['post' => $slug]);
            } else {
                $url = route('home');
            }
        }

        return LaravelLocalization::getLocalizedURL($locale, $url, $attributes, true);
    }
}

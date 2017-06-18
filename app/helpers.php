<?php

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
        if ($boolean) {
            return "<label class='label label-success'>".trans('labels.yes').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.no').'</label>';
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
        return url(config('imagecache.route')."/$template/$image_path");
    }
}

if (!function_exists('form_field')) {
    function form_field($type, $name, $options)
    {
        $widgetsLookup = [
            'checkbox' => 'checkbox',
            'textarea' => 'textarea',
            'checkboxes' => 'choices',
            'radios' => 'choices',
            'select' => 'select',
            'select2' => 'select',
            'autocomplete' => 'select',
        ];

        if (isset($widgetsLookup[$type])) {
            return view("partials.form.fields.{$widgetsLookup[$type]}", $options)
                ->withType($type)
                ->withName($name);
        }

        return view('partials.form.fields.input', $options)
            ->withType($type)
            ->withName($name);
    }
}

if (!function_exists('form_row')) {
    function form_row($type, $name, $options)
    {
        $field = form_field($type, $name, $options)->render();

        return view('partials.form.row', $options)->withName($name)->withField($field);
    }
}

if (!function_exists('form_batch_action')) {
    function form_batch_action($route, $table_id, $actions)
    {
        return view('backend.partials.form.batch-action', compact('route', 'table_id', 'actions'));
    }
}

if (!function_exists('menu_item_access')) {
    function menu_item_access($route_name, $title, $parameters = [], $ability = null, $ability_arguments = [], ...$active_route_patterns)
    {
        if ($ability && !\Illuminate\Support\Facades\Gate::check($ability, $ability_arguments)) {
            return null;
        }

        $route = link_to(route($route_name), $title, $parameters, [], false);

        if (!in_array($route_name, $active_route_patterns, true)) {
            $active_route_patterns[] = $route_name;
        }

        $active_class = active_class(if_route_pattern($active_route_patterns));

        return "<li class=\"{$active_class}\">$route</li>";
    }
}

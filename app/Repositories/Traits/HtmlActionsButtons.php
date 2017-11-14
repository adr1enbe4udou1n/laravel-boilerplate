<?php

namespace App\Repositories\Traits;

use Illuminate\Support\Facades\Gate;

/**
 * Class Html Actions Buttons.
 */
trait HtmlActionsButtons
{
    /**
     * @param $url
     *
     * @return string
     */
    public function getShowButtonHtml($url)
    {
        $title = '<i class="icon-magnifier" data-toggle="tooltip" data-placement="top" title="'.__('buttons.view').'"></i>';

        return "<a href=\"{$url}\" class=\"btn btn-sm btn-success\" data-router-link>{$title}</a>&nbsp;";
    }

    /**
     * @param $route
     * @param $parameters
     *
     * @return string
     */
    public function getPreviewButtonHtml($route, $parameters)
    {
        $title = '<i class="icon-eye" data-toggle="tooltip" data-placement="top" title="'.__('buttons.preview').'"></i>';

        $route = route($route, $parameters);

        return "<a href=\"{$route}\" class=\"btn btn-sm btn-success\" target=\"_blank\">{$title}</a>&nbsp;";
    }

    /**
     * @param $url
     *
     * @return string
     */
    public function getEditButtonHtml($url)
    {
        $title = '<i class="icon-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.edit').'"></i>';

        return "<a href=\"{$url}\" class=\"btn btn-sm btn-primary\" data-router-link>{$title}</a>&nbsp;";
    }

    /**
     * @param       $route
     * @param       $parameters
     * @param null  $ability
     * @param array $arguments
     *
     * @return string
     */
    public function getDeleteButtonHtml($route, $parameters, $ability = null, $arguments = [])
    {
        if (null !== $ability && ! Gate::check('access all backend') && ! Gate::check($ability, $arguments)) {
            return '';
        }

        $route = route($route, $parameters);
        $title = '<i class="icon-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.delete').'"></i>';

        return "<a href=\"{$route}\" class=\"btn btn-sm btn-danger\" data-delete-link>{$title}</a>";
    }
}

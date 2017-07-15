<?php

namespace App\Repositories\Traits;

/**
 * Class Html Actions Buttons.
 */
trait HtmlActionsButtons
{
    /**
     * @param $route
     * @param $parameters
     *
     * @return string
     */
    public function getShowButtonHtml($route, $parameters)
    {
        $title = '<i class="icon-magnifier" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.view').'"></i>';

        return link_to(route($route, $parameters), $title, [
            'class' => 'btn btn-sm btn-success',
        ], false, false).' ';
    }

    /**
     * @param $route
     * @param $parameters
     *
     * @return string
     */
    public function getPreviewButtonHtml($route, $parameters)
    {
        $title = '<i class="icon-eye" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.preview').'"></i>';

        return link_to(route($route, $parameters), $title, [
                'class' => 'btn btn-sm btn-success',
                'target' => '_blank',
            ], false, false).' ';
    }

    /**
     * @param $route
     * @param $parameters
     *
     * @return string
     */
    public function getEditButtonHtml($route, $parameters)
    {
        $title = '<i class="icon-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.edit').'"></i>';

        return link_to(route($route, $parameters), $title, [
            'class' => 'btn btn-sm btn-primary',
        ], false, false).' ';
    }

    /**
     * @param $route
     * @param $parameters
     *
     * @return string
     */
    public function getDeleteButtonHtml($route, $parameters)
    {
        $title = '<i class="icon-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.delete').'"></i>';

        return link_to(route($route, $parameters), $title, [
            'data-toggle' => 'delete-row',
            'data-trans-button-cancel' => trans('buttons.cancel'),
            'data-trans-button-confirm' => trans('buttons.delete'),
            'data-trans-title' => trans('labels.are_you_sure'),
            'class' => 'btn btn-sm btn-danger',
        ], false, false).' ';
    }
}

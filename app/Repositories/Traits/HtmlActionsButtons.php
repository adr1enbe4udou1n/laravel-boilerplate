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
        $title = '<i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.view').'"></i>';

        return link_to(route($route, $parameters), $title, [
            'class' => 'btn btn-xs btn-success',
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
        $title = '<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.preview').'"></i>';

        return link_to(route($route, $parameters), $title, [
                'class' => 'btn btn-xs btn-success',
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
        $title = '<i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.edit').'"></i>';

        return link_to(route($route, $parameters), $title, [
            'class' => 'btn btn-xs btn-primary',
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
        $title = '<i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.delete').'"></i>';

        return link_to(route($route, $parameters), $title, [
            'data-method' => 'delete',
            'data-trans-button-cancel' => trans('buttons.cancel'),
            'data-trans-button-confirm' => trans('buttons.delete'),
            'data-trans-title' => trans('labels.are_you_sure'),
            'class' => 'btn btn-xs btn-danger',
        ], false, false).' ';
    }
}

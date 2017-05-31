<?php

namespace App\Repositories\Traits;

/**
 * Class Html Actions Buttons.
 */
trait HtmlActionsButtons
{

    /**
     * @param $route
     *
     * @param $parameters
     *
     * @return string
     */
    public function getShowButtonHtml($route, $parameters)
    {
        return '<a href="'.route($route, $parameters).'" class="btn btn-xs btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.view').'"></i></a> ';
    }

    /**
     * @param $route
     *
     * @param $parameters
     *
     * @return string
     */
    public function getEditButtonHtml($route, $parameters)
    {
        return '<a href="'.route($route, $parameters).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.edit').'"></i></a> ';
    }

    /**
     * @param $route
     *
     * @param $parameters
     *
     * @return string
     */
    public function getDeleteButtonHtml($route, $parameters)
    {
        return '<a href="'.route($route, $parameters).'"
            data-method="delete"
            data-trans-button-cancel="'.trans('buttons.cancel').'"
            data-trans-button-confirm="'.trans('buttons.delete').'"
            data-trans-title="'.trans('labels.are_you_sure').'"
            class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.delete').'"></i></a> ';
    }
}

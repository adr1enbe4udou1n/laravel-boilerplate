<?php

namespace App\Http\Middleware;

class LocaleSessionRedirect extends \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect
{
    /** @var array */
    protected $except = [
        'favourite/post',
    ];
}

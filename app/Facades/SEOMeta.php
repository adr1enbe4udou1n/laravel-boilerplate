<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SEOMeta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\SEOMeta::class;
    }
}

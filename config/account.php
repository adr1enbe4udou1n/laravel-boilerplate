<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Account settings
    |--------------------------------------------------------------------------
    */

    'updating_enabled' => env('ACCOUNT_UPDATING_ENABLED', true),
    'can_register'     => env('ACCOUNT_CAN_REGISTER', true),
    'can_delete'       => env('ACCOUNT_CAN_DELETE', true),
];

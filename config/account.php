<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Account settings
    |--------------------------------------------------------------------------
    */

    'can_register' => env('ACCOUNT_CAN_REGISTER', true),
    'can_delete' => env('ACCOUNT_CAN_DELETE', true),
    'show_user_profile' => env('ACCOUNT_SHOW_USER_PROFILE', true),
];

<?php

return [

    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | ID
    |
    | Here you may specify the KARIX ID provided by KARIX
    |
    */
    'id'            => env('KARIX_ID'),
    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | token
    |
    | Here you may specify the KARIX TOKEN provided by KARIX
    |
    */
    'token'         => env('KARIX_TOKEN'),
    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | sms_from
    |
    | Here you may specify the KARIX KARIX_FROM that will show as sender to the user
    |
    */
    'sms_from'      => env('KARIX_FROM'),
    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | whatsapp_from
    |
    | Here you may specify the Whatsapp Sender
    |
    */
    'whatsapp_from' => env('KARIX_WHATSAPP')
];

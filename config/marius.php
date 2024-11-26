<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Marius API Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for all API requests to the Marius platform.
    | Default: https://candidature.isme.fr/api
    |
    */
    'base_url' => env('MARIUS_API_BASE_URL', 'https://candidature.isme.fr/api'),

    /*
    |--------------------------------------------------------------------------
    | API Authentication Key
    |--------------------------------------------------------------------------
    |
    | Your authentication key for the Marius API. This should be kept secret
    | and stored in your .env file.
    |
    */
    'api_key' => env('MARIUS_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | Maximum number of seconds to wait for API responses before timing out.
    | Default: 10 seconds
    |
    */
    'timeout' => env('MARIUS_API_TIMEOUT', 10),
];

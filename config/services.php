
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'facebook' => [
        'client_id' => '2694583624133611',
        'client_secret' => 'e496400e367bd248e4957e87449cc1c8',
        'redirect' => 'http://127.0.0.1:8000/auth/facebook/callback'
       

    ],
    'github' => [
        'client_id' => 'ae2f51ec7d81658797f1',
        'client_secret' => 'c17a9a79b03c24062af3fe48cc167aa869d2431a',
        'redirect' => 'http://127.0.0.1:8000/auth/github/callback'
    ],
    'google' => [
        'client_id' => '252446790047-9kim54gq63k36jfs84fd6l42evg5pkco.apps.googleusercontent.com',
        'client_secret' => 'lMampwssojJBOTfbnrkr6or0',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];


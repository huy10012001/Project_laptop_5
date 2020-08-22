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
    'github' => [
        'client_id' => '15173708fa0bf037d1e4',
        'client_secret' => '4c297b2ff44ce58325f6ac536ff6aedab423e70d',
        'redirect' => 'http://localhost:8000/auth/github/callback'
    ],
    'google' => [
        'client_id' => '252446790047-kj38tiiqohrl4dkpm3ore0gkmg0vfhgv.apps.googleusercontent.com',
        'client_secret' => 'NYy-9OEjR9uHPLekbDKYjx0a',
        'redirect' => 'http://localhost:8000/auth/google/callback',
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

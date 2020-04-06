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

    'shopify' => [
        'url' => env('SHOPIFY_URL', 'behindthedot.myshopify.com'),
        'key' => env('SHOPIFY_API_KEY', 'dac85342e0b09d8b472df572b178b42a'),
        'password' => env('SHOPIFY_API_PASSWORD', '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'),
        'shop_url' => env('SHOPIFY_SHOP_URL', 'https://behindthedot.myshopify.com')
    ],

];

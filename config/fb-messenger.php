<?php
/**
 * php artisan fb:greeting {greeting}
 * php artisan fb:get-start {payload?} {--d | delete : delete the start button}
 * php artisan fb:menus
 * fb:whitelisting {--domain=* : Your domain url} {--d | delete : Delete the domain url} {--r | read : Read domain whitelising}
 * php artisan fb:code {--s|size : Image size} {--r|ref : Ref}
 */
return [
    'debug' => env('APP_DEBUG', false),
    'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
    'app_token' => env('MESSENGER_APP_TOKEN'),
    'app_secret' => env('MESSENGER_APP_SECRET'),
    'auto_typing' => true,
    'handlers' => [
        App\Http\Controllers\Handler\DefaultHandler::class
    ],
    'custom_url' => '/messenger',
    'postbacks' => [
        App\Http\Controllers\Handler\StartupPostback::class,
    ],
    'home_url' => [
        'url' => env('MESSENGER_HOME_URL'),
        'webview_share_button' => 'show',
        'in_test' => true,
    ],
];

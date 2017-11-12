<?php

return [
    'host' => env('MAIL_HOST', 'smtp.yandex.ru'),
    'port' => env('MAIL_PORT', '465'),
    'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
    'username' => env('MAIL_USERNAME', null),
    'password' => env('MAIL_PASSWORD', null),
    'address' => env('MAIL_FROM_ADDRESS', null),
    'name' => env('MAIL_FROM_NAME', null),
    'admin' => env('MAIL_ADMIN', null),
];

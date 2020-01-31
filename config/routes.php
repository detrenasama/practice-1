<?php

return [
    [
        'path' => '/',
        'methods' => ['GET'],
        'controller' => App\Controllers\SiteController::class,
        'action' => 'index',
        'name' => 'home'
    ],
    [
        'path' => '/form/send',
        'methods' => ['POST'],
        'controller' => App\Controllers\SiteController::class,
        'action' => 'form',
        'name' => 'form'
    ]
];
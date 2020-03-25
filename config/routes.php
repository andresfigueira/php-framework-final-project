<?php

$routes = [
    [
        'url' => '/',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'index',
    ],
    [
        'url' => '/animals/show',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'show',
    ],
    [
        'url' => '/lista-animales',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'create',
    ],
];

defined('ROUTES')
    or define('ROUTES', $routes);

<?php

$routes = [
    [
        'url' => '/',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'index',
    ],
];
defined('ROUTES')
    or define('ROUTES', $routes);

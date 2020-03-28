<?php

$routes = [
    // GET
    [
        'url' => '/',
        'methods' => ['GET'],
        'controller' => 'publicacion',
        'action' => 'index',
    ],
    [
        'url' => '/acceder',
        'methods' => ['GET'],
        'controller' => 'login',
        'action' => 'index',
    ],
    [
        'url' => '/registro',
        'methods' => ['GET'],
        'controller' => 'login',
        'action' => 'index',
    ],
    [
        'url' => '/cerrar-sesion',
        'methods' => ['GET'],
        'controller' => 'login',
        'action' => 'logout',
    ],
    [
        'url' => '/404',
        'methods' => ['GET'],
        'controller' => 'error',
        'action' => 'pageNotFound',
    ],

    // POST
    [
        'url' => '/acceder',
        'methods' => ['POST'],
        'controller' => 'login',
        'action' => 'login',
    ],
    [
        'url' => '/registro',
        'methods' => ['POST'],
        'controller' => 'login',
        'action' => 'register',
    ],
];

defined('ROUTES')
    or define('ROUTES', $routes);

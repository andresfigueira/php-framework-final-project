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
    [
        'url' => '/animales/crear',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'createView',
    ],
    [
        'url' => '/publicacion/crear',
        'methods' => ['GET'],
        'controller' => 'publicacion',
        'action' => 'createPublView',
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
    [
        'url' => '/animales/crear',
        'methods' => ['POST'],
        'controller' => 'animal',
        'action' => 'create',
    ],
    [
        'url' => '/publicacion/crear',
        'methods' => ['POST'],
        'controller' => 'publicacion',
        'action' => 'createpubl',
    ],
];

defined('ROUTES')
    or define('ROUTES', $routes);

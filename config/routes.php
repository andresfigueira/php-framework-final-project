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
        'url' => '/perfil',
        'methods' => ['GET'],
        'controller' => 'user',
        'action' => 'profile',
    ],
    [
        'url' => '/animales/crear',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'createView',
    ],
    [
        'url' => '/publicaciones/crear',
        'methods' => ['GET'],
        'controller' => 'publicacion',
        'action' => 'createView',
    ],
    [
        'url' => '/perfil/editar',
        'methods' => ['GET'],
        'controller' => 'user',
        'action' => 'updateView',
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
        'url' => '/publicaciones/crear',
        'methods' => ['POST'],
        'controller' => 'publicacion',
        'action' => 'create',
    ],
    [
        'url' => '/perfil/editar',
        'methods' => ['POST'],
        'controller' => 'user',
        'action' => 'update',
    ],
];

defined('ROUTES')
    or define('ROUTES', $routes);

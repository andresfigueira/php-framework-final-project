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
        'url' => '/animales/editar',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'updateView',
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
    [
        'url' => '/publicaciones/editar',
        'methods' => ['GET'],
        'controller' => 'publicacion',
        'action' => 'updateView',
    ],
    [
        'url' => '/publicaciones/id',
        'methods' => ['GET'],
        'controller' => 'publicacion',
        'action' => 'show',
    ],
    [
        'url' => '/animales/id',
        'methods' => ['GET'],
        'controller' => 'animal',
        'action' => 'show',
    ],
    [
        'url' => '/quienes-somos',
        'methods' => ['GET'],
        'controller' => 'about',
        'action' => 'index',
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
        'url' => '/animales/editar',
        'methods' => ['POST'],
        'controller' => 'animal',
        'action' => 'update',
    ],
    [
        'url' => '/animales/borrar',
        'methods' => ['POST'],
        'controller' => 'animal',
        'action' => 'remove',
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
    [
        'url' => '/publicaciones/editar',
        'methods' => ['POST'],
        'controller' => 'publicacion',
        'action' => 'update',
    ],
    [
        'url' => '/publicaciones/borrar',
        'methods' => ['POST'],
        'controller' => 'publicacion',
        'action' => 'remove',
    ],
    [
        'url' => '/publicaciones/inactivar',
        'methods' => ['POST'],
        'controller' => 'publicacion',
        'action' => 'inactivate',
    ],
    [
        'url' => '/animales/inactivar',
        'methods' => ['POST'],
        'controller' => 'animal',
        'action' => 'inactivate',
    ],
];

defined('ROUTES')
    or define('ROUTES', $routes);

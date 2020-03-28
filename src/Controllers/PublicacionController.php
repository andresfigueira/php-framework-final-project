<?php

namespace Controllers;

use Core\Response;
use Repository\PublicacionRepository;

use function Core\dd;

class PublicacionController extends SecurityController
{
    public function index()
    {
        $busqueda = $_GET['busqueda'] ? $_GET['busqueda'] : '';

        $publicaciones = PublicacionRepository::findByBusqueda($busqueda);

        return new Response('publicacion/publicacion.index.php', ['publicaciones' => $publicaciones]);
    }
}

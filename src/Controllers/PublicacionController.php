<?php

namespace Controllers;

use Core\Redirect;
use Core\Response;
use Repository\AnimalRepository;
use Repository\ProvinciaRepository;
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

    public function create()
    {
        // Validación
        $tituloPublicacion = $_POST['titulo'];
        $descripcionPublicacion = $_POST['descripcion'];
        $referenciaPublicacion = $_POST['referencia'];
        $direccion = $_POST['direccion'];
        $provincia = $_POST['provincia_id'];
        $animalId = $_POST['animal_id'];
        $params = [
            'titulo' => $tituloPublicacion,
            'descripcion' => $descripcionPublicacion,
            'referencia' => $referenciaPublicacion,
            'direccion' => $direccion,
            'provincia_id' => $provincia,
            'animal_id' => $animalId,
        ];
        $constraints = [
            'titulo' => [
                'required' => true,
            ],
            'animal_id' => [
                'required' => true,
            ],
        ];

        $validation = $this->validateParams($params, $constraints);

        // Validación incorrecta
        if (!$validation['valid']) {
            $responseError = [
                'errors' => $validation['errors'],
                'params' => $params,
            ];

            return new Response('publicacion/publicacion.create.php', ['responseError' => $responseError]);
        }

        // Crear publicacion
        $publicacion = PublicacionRepository::create($tituloPublicacion, $descripcionPublicacion, $referenciaPublicacion, $direccion, $provincia, $animalId);

        return new Redirect('/');
    }

    public function createView()
    {
        $userAnimalOptions = AnimalRepository::findByUserId($_SESSION['user']['id']);
        $provinciaOptions = ProvinciaRepository::findAll();

        return new Response('publicacion/publicacion.create.php', [
            'animalOptions' => $userAnimalOptions,
            'provinciaOptions' => $provinciaOptions,
        ]);
    }
}

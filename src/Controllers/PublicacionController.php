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

    public function createPubl()
    {
        // Validación
        $tituloPubl = $_POST['titulo_publ'];
        $descripcionPubl = $_POST['descripcion_publ'];
        $referenciaPubl = $_POST['referencia_publ'];
        $direccion = $_POST['direccion'];
        $provincia = $_POST['provincia_id'];
        $animalId = $_POST['animal_id'];
        $params = [
            'titulo_publ' => $tituloPubl,
            'descripcion_publ' => $descripcionPubl,
            'referencia_publ' => $referenciaPubl,
            'direccion' => $direccion,
            'provincia_id' => $provincia,
            'animal_id' => $animalId,
        ];
        $constraints = [
            'titulo_publ' => [
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
        $publicacion = PublicacionRepository::createPublicacion($tituloPubl, $descripcionPubl, $referenciaPubl, $direccion, $provincia, $animalId);

        return new Redirect('/');
    }

    public function createPublView()
    {
        $userAnimalOptions = AnimalRepository::findByUser();
        $provinciaOptions = ProvinciaRepository::findAll();
        
        return new Response('publicacion/publicacion.create.php', ['animalOptions' => $userAnimalOptions, 'provinciaOptions' => $provinciaOptions,], );
    }
}

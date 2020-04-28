<?php

namespace Controllers;

use Core\Redirect;
use Core\Response;
use Helpers\GeneralHelper;
use Repository\AnimalRepository;
use Repository\EstadoRepository;
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

    public function publication()
    {
        $id = $_SESSION['user']['id'];
        $publicaciones = PublicacionRepository::findByUserId($id);
        $animales = AnimalRepository::findByUserId($id);

        return new Response('usuario/usuario.profile.php', [
            'publicaciones' => $publicaciones,
            'animales' => $animales,
        ]);
    }

    public function updateView()
    {
        $provinciaOptions = ProvinciaRepository::findAll();
        $estadoOptions = EstadoRepository::findAll();

        return new Response('publicacion/publicacion.edit.php', [
            'provinciaOptions' => $provinciaOptions,
            'estadoOptions' => $estadoOptions,
        ]);
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

    public function update()
    {
        $publicacionId = $_GET['id']; // Esto es lo que necesito para enviar a la query

        // Validación
        $titulo = $_POST['titulo'];
        $descripcion = GeneralHelper::emptyToNull($_POST['descripcion']);
        $referencia = GeneralHelper::emptyToNull($_POST['referencia']);
        $direccion = GeneralHelper::emptyToNull($_POST['direccion']);        
        $estadoId = $_POST['estado_id'];
        $provinciaId = GeneralHelper::emptyToNull($_POST['provincia_id']);
        $params = [
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'referencia' => $referencia,
            'direccion' => $direccion,
            'estado_id' => $estadoId,
            'provincia_id' => $provinciaId,
        ];
        $constraints = [
            'titulo' => [
                'required' => true,
            ],
            'estado_id' => [
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

            return new Response('usuario/usuario.edit.php', ['responseError' => $responseError]);
        }

        PublicacionRepository::update(
            $publicacionId,
            $titulo,
            $descripcion,
            $referencia,
            $direccion,
            $estadoId,
            $provinciaId,
        );

        $newPublicacion = PublicacionRepository::findById($publicacionId);

        $publicacion['id'] = $newPublicacion;
        dd($publicacion['id']);

        return new Response('usuario/usuario.profile.php', [
            'responseSuccess' => [
                'message' => 'Publicación actualizada correctamente.'
            ]
        ]);
    }
}

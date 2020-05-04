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

        $publicaciones = PublicacionRepository::findActivesByBusqueda($busqueda);

        return new Response('publicacion/publicacion.index.php', ['publicaciones' => $publicaciones]);
    }

    public function updateView()
    {
        SecurityController::redirectUnauthorized();

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
        SecurityController::redirectUnauthorized();

        $userAnimalOptions = AnimalRepository::findActivesByUserId($_SESSION['user']['id']);
        $provinciaOptions = ProvinciaRepository::findAll();

        return new Response('publicacion/publicacion.create.php', [
            'animalOptions' => $userAnimalOptions,
            'provinciaOptions' => $provinciaOptions,
        ]);
    }

    public function show()
    {
        $id = $_GET['id'];

        $publicacion = PublicacionRepository::findActiveById($id);

        if (!$id || empty($publicacion)) {
            return new Redirect('/404');
        }

        return new Response('publicacion/publicacion.show.php', ['publicacion' => $publicacion]);
    }

    public function update()
    {
        $publicacionId = $_POST['publicacion_id'];
        

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

        $publicacionId = $newPublicacion;
        
        return new Redirect('/');
    }

    public function remove()
    {
        $publicacionId = $_POST['publicacion_id'];

        PublicacionRepository::remove(
            $publicacionId,
        );

        return new Redirect('/');
    }

    public function inactivate()
    {
        $estado = 'Inactivo';
        $publicacionId = $_POST['publicacion_id'];

        PublicacionRepository::changeStatus(
            $estado,
            $publicacionId,
        );

        return new Redirect('/');
    }
}

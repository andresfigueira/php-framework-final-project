<?php

namespace Controllers;

use Core\Redirect;
use Repository\AnimalRepository;
use Core\Response;
use Helpers\GeneralHelper;
use Repository\ImagenRepository;
use Repository\RazaAnimalRepository;
use Repository\SexoAnimalRepository;
use Repository\TipoAnimalRepository;
use Repository\EstadoRepository;
use Repository\PublicacionRepository;
use Repository\UserRepository;

use function Core\dd;
use function Helpers\emptyToNull;

class AnimalController extends SecurityController
{
    public function index()
    {
        $animals = AnimalRepository::findAll();

        return new Response('animals/animals.index.php', ['animals' => $animals]);
    }

    public function show()
    {
        $id = $_GET['id'];

        $animal = AnimalRepository::findActiveById($id);

        if (!$id || empty($animal)) {
            return new Redirect('/404');
        }

        return new Response('animal/animal.show.php', ['animal' => $animal]);
    }

    public function create()
    {
        SecurityController::redirectUnauthorized();

        $imagen = $_POST['imagen'];
        if (GeneralHelper::emptyToNull($imagen)) {
            $imagen = ImagenRepository::create($imagen);
        }

        // Validación
        $nombreAnimal = $_POST['nombre_animal'];
        $descripcion = $_POST['descripcion'];
        $tipoAnimal = $_POST['tipo_animal'];
        $fechaNacimientoAnimal = $_POST['fecha_nacimiento_animal'];
        $razaAnimal = $_POST['raza_animal'];
        $sexoAnimal = $_POST['sexo_animal'];
        $params = [
            'nombre_animal' => $nombreAnimal,
            'descripcion' => $descripcion,
            'tipo_animal' => $tipoAnimal,
            'fecha_nacimiento_animal' => $fechaNacimientoAnimal,
            'raza_animal' => $razaAnimal,
            'sexo_animal' => $sexoAnimal,
            'imagen' => $imagen,
        ];
        $constraints = [
            'nombre_animal' => [
                'required' => true,
            ],
            'descripcion' => [
                'required' => true,
            ],
            'tipo_animal' => [
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

            return new Response('animal/animal.create.php', ['responseError' => $responseError]);
        }

        // Crear animal
        $animal = AnimalRepository::create($nombreAnimal, $descripcion, $tipoAnimal, $fechaNacimientoAnimal, $razaAnimal, $sexoAnimal, $imagen);

        return new Redirect('/');
    }

    public function createView()
    {
        $tipoAnimalOptions = TipoAnimalRepository::findAll();
        $razaAnimalOptions = RazaAnimalRepository::findAll();
        $sexoAnimalOptions = SexoAnimalRepository::findAll();

        return new Response('animal/animal.create.php', [
            'tipoAnimalOptions' => $tipoAnimalOptions,
            'razaAnimalOptions' => $razaAnimalOptions,
            'sexoAnimalOptions' => $sexoAnimalOptions
        ]);
    }

    public function updateView()
    {
        SecurityController::redirectUnauthorized();

        $estadoOptions = EstadoRepository::findAll();
        $tipoAnimalOptions = TipoAnimalRepository::findAll();
        $razaAnimalOptions = RazaAnimalRepository::findAll();
        $sexoAnimalOptions = SexoAnimalRepository::findAll();

        return new Response('animal/animal.edit.php', [
            'estadoOptions' => $estadoOptions,
            'tipoAnimalOptions' => $tipoAnimalOptions,
            'razaAnimalOptions' => $razaAnimalOptions,
            'sexoAnimalOptions' => $sexoAnimalOptions,
        ]);
    }

    public function update()
    {
        $animalId = $_POST['animal_id'];

        $imagen = GeneralHelper::emptyToNull($_POST['imagen']);
        $imagenId = GeneralHelper::emptyToNull($_POST['imagen_id']);

        if ($imagen) {
            $imagenBBDD = ImagenRepository::findByUrl($imagen);
            if ($imagenBBDD) {
                $imagenId = $imagenBBDD['id'];
            } else {
                $imagenId = ImagenRepository::create($imagen);
            }
        }

        // Validación
        $nombre = GeneralHelper::emptyToNull($_POST['nombre']);
        $descripcion = GeneralHelper::emptyToNull($_POST['descripcion']);
        $fechaNacimientoAnimal = GeneralHelper::emptyToNull($_POST['fecha_nacimiento_animal']);
        $tipoAnimalId = $_POST['tipo_animal_id'];
        $razaAnimalId = GeneralHelper::emptyToNull($_POST['raza_animal_id']);
        $sexoAnimalId = GeneralHelper::emptyToNull($_POST['sexo_animal_id']);
        $estadoId = $_POST['estado_id'];

        $params = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'fecha_nacimiento_animal' => $fechaNacimientoAnimal,
            'tipo_animal_id' => $tipoAnimalId,
            'raza_animal_id' => $razaAnimalId,
            'sexo_animal_id' => $sexoAnimalId,
            'estado_id' => $estadoId,
            'imagen' => $imagenId,
        ];
        $constraints = [
            'tipo_animal_id' => [
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

        AnimalRepository::update(
            $animalId,
            $nombre,
            $descripcion,
            $fechaNacimientoAnimal,
            $tipoAnimalId,
            $razaAnimalId,
            $sexoAnimalId,
            $estadoId,
            $imagenId,
        );

        $newAnimal = AnimalRepository::findById($animalId);

        $animalId = $newAnimal;

        return new Redirect('/perfil');
    }

    public function remove()
    {
        $animalId = $_POST['animal_id'];

        AnimalRepository::remove(
            $animalId,
        );

        return new Redirect('/perfil');
    }

    public function inactivate()
    {
        $estado = 'Inactivo';
        $animalId = $_POST['animal_id'];
        $publicacionesConElAnimal = PublicacionRepository::findAllByAnimalId($animalId);

        AnimalRepository::changeStatus(
            $estado,
            $animalId,
        );

        foreach ($publicacionesConElAnimal as $publicacion) {
            PublicacionRepository::changeStatus($estado, $publicacion['id']);
        }

        return new Redirect('/perfil');
    }
}

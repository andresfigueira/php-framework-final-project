<?php

namespace Controllers;

use Core\Redirect;
use Repository\AnimalRepository;
use Core\Response;
use Helpers\GeneralHelper;
use Repository\RazaAnimalRepository;
use Repository\SexoAnimalRepository;
use Repository\TipoAnimalRepository;

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
        if (array_key_exists('id', $_GET)) {
            $id = $_GET['id'];

            $animal = AnimalRepository::findById($id);

            return new Response('base/base.index.php', ['animal' => $animal]);
        }
    }

    public function create()
    {
        // Validación
        $nombre_animal = $_POST['nombre_animal'];
        $descripcion = $_POST['descripcion'];
        $tipoAnimal = $_POST['tipo_animal'];
        $fechaNacimientoAnimal = $_POST['fecha_nacimiento_animal'];
        $razaAnimal = $_POST['raza_animal'];
        $sexoAnimal = $_POST['sexo_animal'];
        $params = [
            'nombre_animal' => $nombre_animal,
            'descripcion' => $descripcion,
            'tipo_animal' => $tipoAnimal,
            'fecha_nacimiento_animal' => $fechaNacimientoAnimal,
            'raza_animal' => $razaAnimal,
            'sexo_animal' => $sexoAnimal,
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
        $animal = AnimalRepository::createAnimal($nombre_animal, $descripcion, $tipoAnimal, $fechaNacimientoAnimal, $razaAnimal,$sexoAnimal);

        return new Redirect('/');
    }

    public function createView()
    {
        $tipoAnimalOptions = TipoAnimalRepository::findAll();
        $razaAnimalOptions = RazaAnimalRepository::findAll();
        $sexoAnimalOptions = SexoAnimalRepository::findAll();
        
        return new Response('animal/animal.create.php', ['tipoAnimalOptions' => $tipoAnimalOptions, 'razaAnimalOptions' => $razaAnimalOptions, 'sexoAnimalOptions' => $sexoAnimalOptions,],);
    }
}
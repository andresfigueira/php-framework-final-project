<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;
use DateTime;
use Helpers\GeneralHelper;

use function Core\dd;

class AnimalRepository extends SecurityController
{
    public static function findById($id)
    {
        $db = new DatabaseController();
        $params = [
            'id' => $id,
        ];

        $animal = $db->selectOne(
            'SELECT *
            FROM animal
            WHERE id = :id',
            $params
        );

        return $animal;
    }

    public static function findAll()
    {
        $db = new DatabaseController();

        $animal = $db->select(
            'SELECT *
            FROM animal'
        );

        return $animal;
    }

    public static function findByUser()
    {
        $db = new DatabaseController();

        $params = [
            'usuario' => $_SESSION['user']['id'],
        ];

        $animal = $db->select(
            'SELECT *
            FROM animal
            WHERE usuario_id = :usuario',
            $params
        );

        return $animal;
    }

    public static function createAnimal(String $nombre_animal, String $descripcion, String $tipoAnimal, String $fechaNacimientoAnimal, String $razaAnimal, String $sexoAnimal)
    {
        $db = new DatabaseController();

        $fechaNacimientoAnimal = GeneralHelper::emptyToNull($fechaNacimientoAnimal);

        if ($fechaNacimientoAnimal) {
            $fechaNacimientoAnimal = new DateTime($fechaNacimientoAnimal);
            date_format($fechaNacimientoAnimal, 'Y-m-d');
        }
        
        $params = [
            'nombre_animal' => $nombre_animal,
            'descripcion' => $descripcion,
            'tipo_animal_id' => $tipoAnimal,
            'usuario_id' => $_SESSION['user']['id'],
            'fecha_nacimiento_animal' => $fechaNacimientoAnimal,
            'raza_animal_id' => GeneralHelper::emptyToNull($razaAnimal),
            'sexo_animal_id' => GeneralHelper::emptyToNull($sexoAnimal),
        ];

        $query = '  INSERT INTO animal
                        (nombre,
                        descripcion,
                        tipo_animal_id,
                        usuario_id,
                        fecha_nacimiento,
                        raza_animal_id,
                        sexo_animal_id,
                        estado_id)
                    VALUES
                        (:nombre_animal, 
                        :descripcion, 
                        :tipo_animal_id, 
                        :usuario_id,
                        :fecha_nacimiento_animal,
                        :raza_animal_id,
                        :sexo_animal_id,
                        (SELECT id FROM estado WHERE nombre = "Activo"))';


        $animalId = $db->query($query, $params);

        $animal = AnimalRepository::findById($animalId);

        return $animal;
    }
}

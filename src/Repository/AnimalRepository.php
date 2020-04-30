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
        $a = new AnimalRepository();
        $db = new DatabaseController();
        $params = [
            'id' => $id,
        ];

        $animal = $db->selectOne(
            implode(' ', [
                $a->baseSelectQuery(),
                "WHERE a.id = :id"
            ]),
            $params
        );

        return $animal;
    }

    public static function findAll()
    {
        $a = new AnimalRepository();
        $db = new DatabaseController();

        $animal = $db->select(
            $a->baseSelectQuery()
        );

        return $animal;
    }

    public static function findByUserId($id)
    {
        $a = new AnimalRepository();
        $db = new DatabaseController();

        $params = [
            'usuario' => $id,
        ];

        $animal = $db->select(
            implode(' ', [
                $a->baseSelectQuery(),
                'WHERE usuario_id = :usuario'
            ]),
            $params
        );
        return $animal;
    }

    public static function create(String $nombreAnimal, String $descripcion, String $tipoAnimal, String $fechaNacimientoAnimal, String $razaAnimal, String $sexoAnimal, String $imagen)
    {
        $db = new DatabaseController();

        $fechaNacimientoAnimal = GeneralHelper::emptyToNull($fechaNacimientoAnimal);

        if ($fechaNacimientoAnimal) {
            $fechaNacimientoAnimal = new DateTime($fechaNacimientoAnimal);
            $fechaNacimientoAnimal = date_format($fechaNacimientoAnimal, 'Y-m-d');
        }

        $params = [
            'nombre_animal' => $nombreAnimal,
            'descripcion' => $descripcion,
            'tipo_animal_id' => $tipoAnimal,
            'usuario_id' => $_SESSION['user']['id'],
            'fecha_nacimiento_animal' => $fechaNacimientoAnimal,
            'raza_animal_id' => GeneralHelper::emptyToNull($razaAnimal),
            'sexo_animal_id' => GeneralHelper::emptyToNull($sexoAnimal),
            'imagen_id' => GeneralHelper::emptyToNull($imagen),
        ];

        $query = '  INSERT INTO animal
                        (nombre,
                        descripcion,
                        tipo_animal_id,
                        usuario_id,
                        fecha_nacimiento,
                        raza_animal_id,
                        sexo_animal_id,
                        imagen_id,
                        estado_id)
                    VALUES
                        (:nombre_animal, 
                        :descripcion, 
                        :tipo_animal_id, 
                        :usuario_id,
                        :fecha_nacimiento_animal,
                        :raza_animal_id,
                        :sexo_animal_id,
                        :imagen_id,
                        (SELECT id FROM estado WHERE nombre = "Activo"))';


        $animalId = $db->query($query, $params);

        $animal = AnimalRepository::findById($animalId);

        return $animal;
    }

    public static function update(
        $animalId,
        $nombre,
        $descripcion,
        $fechaNacimientoAnimal,
        $tipoAnimalId,
        $razaAnimalId,
        $sexoAnimalId,
        $estadoId,
        $imagenId
        ) {
        $db = new DatabaseController();

        $fechaNacimientoAnimal = GeneralHelper::emptyToNull($fechaNacimientoAnimal);

        if ($fechaNacimientoAnimal) {
            $fechaNacimientoAnimal = new DateTime($fechaNacimientoAnimal);
            $fechaNacimientoAnimal = date_format($fechaNacimientoAnimal, 'Y-m-d');
        }

        $params = [
            'animal_id' => $animalId,
            'nombre' => GeneralHelper::emptyToNull($nombre),
            'descripcion' => GeneralHelper::emptyToNull($descripcion),
            'fecha_nacimiento' => $fechaNacimientoAnimal,
            'tipo_animal_id' => $tipoAnimalId,
            'raza_animal_id' => GeneralHelper::emptyToNull($razaAnimalId),
            'sexo_animal_id' => GeneralHelper::emptyToNull($sexoAnimalId),
            'estado_id' => $estadoId,
            'imagen_id' => GeneralHelper::emptyToNull($imagenId),
        ];

        $query = '  UPDATE animal
                    SET nombre = :nombre,
                        descripcion = :descripcion,
                        fecha_nacimiento = :fecha_nacimiento,
                        tipo_animal_id = :tipo_animal_id,
                        raza_animal_id = :raza_animal_id,
                        sexo_animal_id = :sexo_animal_id,
                        estado_id = :estado_id,
                        imagen_id = :imagen_id
                    WHERE id = :animal_id';
        
        $animalId = $db->query($query, $params);

        $animal = PublicacionRepository::findById($animalId);

        return $animal;
    }

    private function baseSelectQuery(): String
    {
        $query = 'SELECT
            a.*,
            i.url AS imagen,
            ta.nombre AS tipo_animal,
            r.nombre AS raza_animal,
            s.nombre AS sexo_animal
            FROM animal a
            LEFT JOIN tipo_animal ta ON a.tipo_animal_id = ta.id
            LEFT JOIN raza_animal r ON a.raza_animal_id = r.id
            LEFT JOIN sexo_animal s ON a.sexo_animal_id = s.id
            LEFT JOIN imagen i ON a.imagen_id = i.id';

        return $query;
    }
}

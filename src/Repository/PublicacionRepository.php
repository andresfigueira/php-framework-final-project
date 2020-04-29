<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;
use Helpers\GeneralHelper;

use function Core\dd;

class PublicacionRepository extends SecurityController
{
    public static function findById($id): array
    {
        $p = new PublicacionRepository();
        $db = new DatabaseController();
        $params = [
            'id' => $id,
        ];

        $publicacion = $db->selectOne(
            implode(' ', [
                $p->baseSelectQuery(),
                "WHERE p.id = :id"
            ]),
            $params
        );

        return $publicacion;
    }

    public static function findAll(): array
    {
        $p = new PublicacionRepository();
        $db = new DatabaseController();

        $publicaciones = $db->select(
            implode(' ', [
                $p->baseSelectQuery(),
                "ORDER BY creacion DESC, id DESC"
            ]),
        );

        return $publicaciones;
    }

    public static function findByBusqueda(String $busqueda): array
    {
        $p = new PublicacionRepository();
        $db = new DatabaseController();
        $busqueda = trim($busqueda);
        $params = [
            'titulo' => "%$busqueda%",
            'nombreAnimal' => "%$busqueda%",
            'provincia' => "%$busqueda%",
            'raza' => "%$busqueda%",
            'tipoAnimal' => "%$busqueda%",
            'sexoAnimal' => "%$busqueda%",
            'nombreUsuario' => "%$busqueda%",
            'referencia' => $busqueda,
        ];

        $publicaciones = $db->select(
            implode(' ', [
                $p->baseSelectQuery(),
                "WHERE p.titulo LIKE :titulo
                    OR a.nombre LIKE :nombreAnimal
                    OR pr.nombre LIKE :provincia
                    OR ra.nombre LIKE :raza
                    OR ta.nombre LIKE :tipoAnimal
                    OR sa.nombre LIKE :sexoAnimal
                    OR u.nombre LIKE :nombreUsuario 
                    OR p.referencia LIKE :referencia
                ORDER BY creacion DESC, id DESC"
            ]),
            $params
        );

        return $publicaciones;
    }

    public static function findByUserId($userId): array
    {
        $p = new PublicacionRepository();
        $db = new DatabaseController();
        $params = [
            'usuario_id' => $userId,
        ];

        $publicaciones = $db->select(
            implode(' ', [
                $p->baseSelectQuery(),
                "WHERE p.usuario_id = :usuario_id
                ORDER BY creacion DESC, id DESC"
            ]),
            $params
        );

        return $publicaciones;
    }

    private function baseSelectQuery(): String
    {
        $query = 'SELECT
                p.*,
                e.nombre AS estado,
                pr.nombre AS provincia,
                CONCAT(u.nombre, " ", u.apellido)  AS nombre_usuario,
                u.email  AS email,
                a.nombre AS nombre_animal,
                a.descripcion AS descripcion_animal,
                a.fecha_nacimiento AS fecha_nacimiento_animal,
                e2.nombre AS estado_animal,
                ta.nombre AS tipo_animal,
                IFNULL(ra.nombre, "Sin raza") AS raza_animal,
                sa.nombre AS sexo_animal,       
                i.url AS imagen
            FROM publicacion p
            INNER JOIN animal a ON p.animal_id = a.id
            LEFT JOIN tipo_animal ta ON a.tipo_animal_id = ta.id
            LEFT JOIN raza_animal ra ON a.raza_animal_id = ra.id
            LEFT JOIN sexo_animal sa ON a.sexo_animal_id = sa.id
            LEFT JOIN imagen i ON a.imagen_id = i.id
            INNER JOIN estado e ON p.estado_id = e.id
            INNER JOIN estado e2 ON a.estado_id = e2.id
            INNER JOIN usuario u ON p.usuario_id = u.id
            LEFT JOIN provincia pr ON p.provincia_id = pr.id';

        return $query;
    }

    public static function create(String $tituloPublicacion, String $descripcionPublicacion, String $referenciaPublicacion, String $direccion, String $provincia, String $animalId)
    {
        $db = new DatabaseController();
        
        $params = [
            'titulo' => $tituloPublicacion,
            'descripcion' => GeneralHelper::emptyToNull($descripcionPublicacion),
            'referencia' => GeneralHelper::emptyToNull($referenciaPublicacion),
            'usuario_id' => $_SESSION['user']['id'],
            'direccion' => GeneralHelper::emptyToNull($direccion),
            'provincia_id' => GeneralHelper::emptyToNull($provincia),
            'animal_id' => $animalId,
        ];

        $query = '  INSERT INTO publicacion
                        (titulo,
                        descripcion,
                        referencia,
                        usuario_id,
                        direccion,
                        provincia_id,
                        animal_id,
                        estado_id)
                    VALUES
                        (:titulo, 
                        :descripcion, 
                        :referencia, 
                        :usuario_id,
                        :direccion,
                        :provincia_id,
                        :animal_id,
                        (SELECT id FROM estado WHERE nombre = "Activo"))';


        $publicacionId = $db->query($query, $params);

        $publicacion = PublicacionRepository::findById($publicacionId);

        return $publicacion;
    }

    public static function update(
        $publicacionId,
        $titulo,
        $descripcion,
        $referencia,
        $direccion,
        $estadoId,
        $provinciaId
    ) {
        $db = new DatabaseController();
        $params = [
            'publicacion_id' => $publicacionId,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'referencia' => $referencia,
            'direccion' => $direccion,
            'estado_id' => $estadoId,
            'provincia_id' => $provinciaId,
        ];

        $query = '  UPDATE publicacion
                    SET titulo = :titulo,
                        descripcion = :descripcion,
                        referencia = :referencia,
                        direccion = :direccion,
                        estado_id = :estado_id,
                        provincia_id = :provincia_id
                    WHERE id = :publicacion_id';
        
        $publicacionId = $db->query($query, $params);

        $publicacion = PublicacionRepository::findById($publicacionId);

        return $publicacion;
    }
}

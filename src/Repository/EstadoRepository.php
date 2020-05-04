<?php

namespace Repository;

use function Core\dd;

use Controllers\DatabaseController;
use Controllers\SecurityController;

class EstadoRepository extends SecurityController
{
    public static function findAll(){
        $db = new DatabaseController();

        $estado = $db->select(
            'SELECT *
            FROM estado'
        );

        return $estado;
    }

    public static function findIdByName($nombreEstado){
        $db = new DatabaseController();
        $params = [
            'nombre' => $nombreEstado,
        ];

        $estado = $db->selectOne(
            'SELECT id
            FROM estado
            WHERE nombre = :nombre',
            $params
        );

        return $estado['id'];
    }
}
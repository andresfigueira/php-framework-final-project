<?php

namespace Repository;

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
}
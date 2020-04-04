<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

class ProvinciaRepository extends SecurityController
{
    public static function findAll(){
        $db = new DatabaseController();

        $provincias = $db->select(
            'SELECT *
            FROM provincia'
        );

        return $provincias;
    }
}
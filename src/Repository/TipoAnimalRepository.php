<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

class TipoAnimalRepository extends SecurityController
{
    public static function findAll(){
        $db = new DatabaseController();

        $tiposAnimal = $db->select(
            'SELECT *
            FROM tipo_animal'
        );

        return $tiposAnimal;
    }
}
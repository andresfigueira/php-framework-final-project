<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

class SexoAnimalRepository extends SecurityController
{
    public static function findAll(){
        $db = new DatabaseController();

        $sexoAnimal = $db->select(
            'SELECT *
            FROM sexo_animal'
        );

        return $sexoAnimal;
    }
}
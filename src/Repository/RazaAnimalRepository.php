<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

class RazaAnimalRepository extends SecurityController
{
    public static function findAll(){
        $db = new DatabaseController();

        $razasAnimal = $db->select(
            'SELECT *
            FROM raza_animal'
        );

        return $razasAnimal;
    }
}
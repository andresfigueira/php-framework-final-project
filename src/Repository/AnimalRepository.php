<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

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
}

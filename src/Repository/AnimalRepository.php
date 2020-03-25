<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

class AnimalRepository extends SecurityController
{
    public static function findById($id)
    {
        $db = new DatabaseController();

        $animal = $db->selectOne(
            'SELECT *
            FROM estado
            WHERE id = :id',

            ['id' => $id]
        );

        return $animal || [];
    }
}

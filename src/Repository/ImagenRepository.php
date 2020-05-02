<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

class ImagenRepository extends SecurityController
{
    public static function findAll(){
        $db = new DatabaseController();

        $imagenes = $db->select(
            'SELECT *
            FROM imagen'
        );

        return $imagenes;
    }

    public static function findByUrl(String $url){
        $db = new DatabaseController();

        $params = [
            'url' => $url
        ];

        $imagen = $db->selectOne(
            'SELECT *
            FROM imagen
            WHERE url = :url',
            $params
        );

        return $imagen;
    }

    public static function create(String $url){
        $db = new DatabaseController();

        $params = [
            'url' => $url,
        ];

        $query = '  INSERT INTO imagen
                        (url)
                    VALUES
                        (:url)';

        $imagen = $db->query($query, $params);

        return $imagen;
    }
}
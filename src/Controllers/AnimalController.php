<?php

namespace Controllers;

use Repository\AnimalRepository;
use Core\Response;

class AnimalController extends SecurityController
{
    public function index()
    {
        $animals = AnimalRepository::findAll();

        return new Response('animals/animals.index.php', ['animals' => $animals]);
    }

    public function show()
    {
        if (array_key_exists('id', $_GET)) {
            $id = $_GET['id'];

            $animal = AnimalRepository::findById($id);

            return new Response('base/base.index.php', ['animal' => $animal]);
        }
    }
}

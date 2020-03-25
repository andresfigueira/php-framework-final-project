<?php

namespace Controllers;

class AnimalController extends SecurityController
{
    public function index()
    {
        // $db = new DatabaseController();

        // $animals = $db->selectOne('SELECT * FROM estado');

        // return new Response('layout.php', ['animals' => $animals]);
    }

    public function show()
    {
        // $id = $_GET['id'];

        // if ($id) {
        //     dd("HERE ID: " . $_GET['id']);
        //     $animal = AnimalRepository::findById($id);
        //     dd($animal);
        // }

        // return new Response('layout.php', ['animals' => $animals]);
    }

    public function create()
    {
        echo 'HOLA y ADIOS...';
    }
}

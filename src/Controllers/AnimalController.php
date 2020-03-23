<?php

namespace Controllers;

use Resources\Response;

class AnimalController extends SecurityController
{
    public function index()
    {
        $db = new DatabaseController();

        $animals = $db->select('SELECT * FROM animal');

        return new Response('layout.php', ['animals' => $animals]);
    }
}

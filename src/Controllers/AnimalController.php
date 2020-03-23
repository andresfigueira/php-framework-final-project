<?php

namespace Controllers;

use Resources\Response;

class AnimalController extends SecurityController
{
    public function index()
    {
        return new Response('layout.php', ['test' => 'test']);
    }
}

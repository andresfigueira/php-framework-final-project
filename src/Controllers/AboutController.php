<?php

namespace Controllers;

use Core\Response;

class AboutController
{
    public function index()
    {
        return new Response('quienes-somos/quienes-somos.index.php');
    }
}

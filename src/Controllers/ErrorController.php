<?php

namespace Controllers;

use Core\Response;

class ErrorController extends SecurityController
{
    public function pageNotFound()
    {
        return new Response('error/pageNotFound.php');
    }
}

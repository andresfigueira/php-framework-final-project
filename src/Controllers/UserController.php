<?php

namespace Controllers;

use Core\Response;
use Repository\UserRepository;

use function Core\dd;

class UserController extends SecurityController
{
    public function profile()
    {
        $user = $_SESSION['user'];

        return new Response('usuario/usuario.profile.php', ['user' => $user]);
    }
}

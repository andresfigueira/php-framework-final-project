<?php

namespace Controllers;

use Core\Response;
use Repository\AnimalRepository;
use Repository\PublicacionRepository;
use Repository\UserRepository;

use function Core\dd;

class UserController extends SecurityController
{
    public function profile()
    {
        $id = $_SESSION['user']['id'];
        $publicaciones = PublicacionRepository::findByUserId($id);
        $animales = AnimalRepository::findByUserId($id);

        return new Response('usuario/usuario.profile.php', [
            'publicaciones' => $publicaciones,
            'animales' => $animales,
        ]);
    }
}

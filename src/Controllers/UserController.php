<?php

namespace Controllers;

use Core\Response;
use Helpers\GeneralHelper;
use Repository\AnimalRepository;
use Repository\ImagenRepository;
use Repository\ProvinciaRepository;
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

    public function updateView()
    {
        $provinciaOptions = ProvinciaRepository::findAll();

        return new Response('usuario/usuario.edit.php', [
            'provinciaOptions' => $provinciaOptions,
        ]);
    }

    public function update()
    {
        $userId = $_SESSION['user']['id'];
        $currentUser = UserRepository::findById($userId);

        $imagen = GeneralHelper::emptyToNull($_POST['imagen']);
        $imagenId = GeneralHelper::emptyToNull($_POST['imagen_id']);
        if ($imagen != $currentUser['imagen'] && $imagen) {
            $imagenId = ImagenRepository::create($imagen);
        }

        // Validación
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $direccion = GeneralHelper::emptyToNull($_POST['direccion']);
        $telefono1 = GeneralHelper::emptyToNull($_POST['telefono_1']);
        $telefono2 = GeneralHelper::emptyToNull($_POST['telefono_2']);
        $provinciaId = GeneralHelper::emptyToNull($_POST['provincia_id']);
        $params = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'direccion' => $direccion,
            'telefono_1' => $telefono1,
            'telefono_2' => $telefono2,
            'provincia_id' => $provinciaId,
            'imagen_id' => $imagenId,
        ];
        $constraints = [
            'nombre' => [
                'required' => true,
            ],
            'apellido' => [
                'required' => true,
            ],
            'email' => [
                'required' => true,
            ],
        ];

        $validation = $this->validateParams($params, $constraints);


        // Validación incorrecta
        if (!$validation['valid']) {
            $responseError = [
                'errors' => $validation['errors'],
                'params' => $params,
            ];

            return new Response('usuario/usuario.edit.php', ['responseError' => $responseError]);
        }

        UserRepository::update(
            $nombre,
            $apellido,
            $email,
            $direccion,
            $telefono1,
            $telefono2,
            $provinciaId,
            $imagenId,
            $userId
        );

        $newUser = UserRepository::findById($userId);

        $_SESSION['user'] = $newUser;

        return new Response('usuario/usuario.profile.php', [
            'responseSuccess' => [
                'message' => 'Perfil actualizado correctamente.'
            ]
        ]);
    }
}

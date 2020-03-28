<?php

namespace Controllers;

use Core\Redirect;
use Core\Response;
use Repository\UserRepository;

use function Core\dd;

class LoginController extends SecurityController
{
    public function index()
    {
        if (!SecurityController::isLoggedIn()) {
        return new Response('login/login.index.php');
        }

        return new Redirect('/');
    }

    public function login()
    {
        // Validación
        $email = $_POST['email'];
        $password = $_POST['password'];
        $params = [
            'email' => $email,
            'password' => $password,
        ];
        $constraints = [
            'email' => [
                'required' => true,
            ],
        ];

        $validation = $this->validateParams($params, $constraints);

        // Validación incorrecta
        if (!$validation['valid']) {
            $loginResponseError = [
                'errors' => $validation['errors'],
                'params' => $params,
            ];

            return new Response('login/login.index.php', ['loginResponseError' => $loginResponseError]);
        }

        // Busco credenciales en BBDD
        $user = UserRepository::findUserByEmailAndPassword($email, $password);

        // Credenciales incorrectas
        if (empty($user)) {
            $loginResponseError = [
                'errors' => [
                    'email' => 'Email o password incorrecto'
                ],
                'params' => $params,
            ];

            return new Response('login/login.index.php', ['loginResponseError' => $loginResponseError]);
        }

        // Credenciales correctas
        $security = new SecurityController();
        $security->setUser($user);
        $security->storeSession();

        return new Redirect('/');
    }

    public function register()
    {
        // Validación
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $params = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'password' => $password,
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
            'password' => [
                'required' => true,
            ],
        ];

        $validation = $this->validateParams($params, $constraints);

        // Email duplicado
        if ($validation['valid']) {
            $emailDuplicated = UserRepository::findByEmail($email);

            if (!empty($emailDuplicated)) {
                $validation = [
                    'errors' => [
                        'email' => 'Email duplicado'
                    ],
                    'valid' => false,
                ];
            }
        }

        // Validación incorrecta
        if (!$validation['valid']) {
            $registerResponseError = [
                'errors' => $validation['errors'],
                'params' => $params,
            ];

            return new Response('login/login.index.php', ['registerResponseError' => $registerResponseError]);
        }

        // Crear usuario
        $user = UserRepository::createUser($nombre, $apellido, $email, $password);

        // Almacenar sesión
        $security = new SecurityController();
        $security->setUser($user);
        $security->storeSession();

        return new Redirect('/');
    }

    public function logout()
    {
        $security = new SecurityController();

        $security->destroySession();

        return new Redirect('/');
    }
}

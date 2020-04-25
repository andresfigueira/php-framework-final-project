<?php

namespace Repository;

use Controllers\DatabaseController;
use Controllers\SecurityController;

use function Core\dd;

class UserRepository extends SecurityController
{
    public static function findById($id)
    {
        $u = new UserRepository();
        $db = new DatabaseController();
        $params = [
            'id' => $id,
        ];

        $user = $db->selectOne(
            implode(' ', [
                $u->baseSelectQuery(),
                "WHERE u.id = :id"
            ]),
            $params
        );

        return $user;
    }

    public static function findByEmail($email)
    {
        $u = new UserRepository();
        $db = new DatabaseController();
        $params = [
            'email' => $email,
        ];

        $user = $db->selectOne(
            implode(' ', [
                $u->baseSelectQuery(),
                "WHERE email = :email"
            ]),
            $params
        );

        return $user;
    }

    public static function findAll()
    {
        $u = new UserRepository();
        $db = new DatabaseController();

        $user = $db->select(
            $u->baseSelectQuery()
        );

        return $user;
    }

    public static function findUserByEmailAndPassword(String $email, String $password)
    {
        $u = new UserRepository();
        $db = new DatabaseController();
        $params = [
            'email' => $email
        ];

        $user = $db->selectOne(
            implode(' ', [
                $u->baseSelectQuery(),
                "WHERE email = :email"
            ]),
            $params
        );

        if (!empty($user) && !SecurityController::verifyPassword($password, $user['password'])) {
            return [];
        }

        return $user;
    }

    public static function update(
        $nombre,
        $apellido,
        $email,
        $direccion,
        $telefono_1,
        $telefono_2,
        $provincia_id,
        $imagen_id
    ) {
        $db = new DatabaseController();
        $params = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'direccion' => $direccion,
            'telefono_1' => $telefono_1,
            'telefono_2' => $telefono_2,
            'provincia_id' => $provincia_id,
            'imagen_id' => $imagen_id,
            'usuario_id' => $_SESSION['user']['id'],
        ];

        $query = '  UPDATE usuario
                    SET nombre = :nombre,
                        apellido = :apellido,
                        email = :email,
                        direccion = :direccion,
                        telefono_1 = :telefono_1, 
                        telefono_2 = :telefono_2,
                        provincia_id = :provincia_id,
                        imagen_id = :imagen_id
                    WHERE id = :usuario_id';

        $userId = $db->query($query, $params);

        $user = UserRepository::findById($userId);

        return $user;
    }

    public static function create(String $nombre, String $apellido, String $email, String $password)
    {
        $db = new DatabaseController();
        $params = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'password' => SecurityController::encryptPassword($password),
        ];

        $query = '  INSERT INTO usuario
                        (nombre,
                        apellido,
                        email,
                        password,
                        rol_usuario_id)
                    VALUES
                        (:nombre, 
                        :apellido, 
                        :email, 
                        :password,
                        (SELECT id FROM rol_usuario WHERE nombre = "Particular"))';


        $userId = $db->query($query, $params);

        $user = UserRepository::findById($userId);

        return $user;
    }

    private function baseSelectQuery(): String
    {
        $query = 'SELECT
                u.*,
                i.url AS imagen,
                p.nombre AS provincia,
                r.nombre AS rol_usuario
            FROM usuario u
            LEFT JOIN imagen i ON u.imagen_id = i.id
            LEFT JOIN rol_usuario r ON u.rol_usuario_id = r.id
            LEFT JOIN provincia p ON u.provincia_id = p.id
        ';

        return $query;
    }
}

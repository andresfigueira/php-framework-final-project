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
                "WHERE id = :id"
            ]),
            $params
        );

        return $user;
    }

    public static function findByEmail($email)
    {
        $db = new DatabaseController();
        $params = [
            'email' => $email,
        ];

        $user = $db->selectOne(
            'SELECT *
            FROM usuario
            WHERE email = :email',
            $params
        );

        return $user;
    }

    public static function findAll()
    {
        $db = new DatabaseController();

        $user = $db->select(
            'SELECT *
            FROM usuario'
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

    public static function createUser(String $nombre, String $apellido, String $email, String $password)
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
                i.url AS imagen
            FROM usuario u
            LEFT JOIN imagen i ON u.imagen_id = i.id';

        return $query;
    }
}

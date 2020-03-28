<?php

namespace Controllers;

use Core\App;
use PDO;

use function Core\dd;

class DatabaseController extends GlobalController
{
    private PDO $conn;
    private string $host;
    private string $database;
    private string $user;
    private string $password;
    private string $charset;
    private array $options = [];

    public function __construct()
    {
        $config = GLOBAL_CONFIG['database'][App::getEnv()];

        $this->host = $config['host'];
        $this->database = $config['database'];
        $this->user = $config['user'];
        $this->password = $config['password'];
        $this->charset = $config['charset'];
        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->connect();
    }

    public function connect()
    {
        $connection = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";

        try {
            $this->conn = new PDO($connection, $this->user, $this->password, $this->options);
        } catch (\PDOException $e) {
            // TODO:
            // Mejorar error
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function select(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result : [];
    }

    public function selectOne(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch();

        return $result ? $result : [];
    }

    public function query(string $query, array $params = [])
    {
        $this->conn
            ->prepare($query)
            ->execute($params);

        return $this->conn->lastInsertId();
    }
}

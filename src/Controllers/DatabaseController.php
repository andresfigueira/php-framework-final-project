<?php

namespace Controllers;

use PDO;

class DatabaseController
{
    protected PDO $pdo;
    protected string $host;
    protected string $database;
    protected string $user;
    protected string $password;
    protected string $charset;
    protected array $options = [];

    public function __construct()
    {
        $config = GLOBAL_CONFIG['database'][GLOBAL_ENV];

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
            $this->pdo = new PDO($connection, $this->user, $this->password, $this->options);
        } catch (\PDOException $e) {
            // TODO:
            // Mejorar error
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function select(string $query, array $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll();

        return $result;
    }
}

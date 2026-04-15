<?php

class PDODatabase
{
    private $pdo;

    public function __construct($dsn, $username, $password)
    {
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die("Error de conexión en PDODatabase: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
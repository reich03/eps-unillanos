<?php

class Database
{

    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
    }

    function connect()
    {
        try {
            $connection = "pgsql:host=" . $this->host . ";dbname=" . $this->db;
            error_log('credenciales ' . "pgsql:host=" . $this->host . ";dbname=" . $this->db);
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($connection, $this->user, $this->password, $options);
             error_log('objeto pdo ' . print_r($pdo, true));
            error_log('Conexión a BD exitosa');
            return $pdo;
        } catch (PDOException $e) {
            error_log('Error connection: a la base de datos ' . $e->getMessage());
        }
    }

     public function beginTransaction()
    {
        return $this->connect()->beginTransaction();
    }

    public function commit()
    {
        return $this->connect()->commit();
    }

    public function rollback()
    {
        return $this->connect()->rollback();
    }
}

<?php
namespace App\Database;

use PDO;
use PDOException;

class database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'todolistdata';
    private $pdo;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to Exception
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}


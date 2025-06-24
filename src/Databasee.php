<?php

namespace Pavel\Db;

use PDO;
use PDOException;

class Databasee
{
    private string $host;
    private string $db;

    private string $user;

    private string $pass;

    private string $charset;

    private PDO $pdo;
    private string $error;
    private $stmt;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASS'];
        $this->charset = $_ENV['DB_CHARSET'];

        // DSN строка для подключения
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ошибки через исключения
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // по умолчанию ассоциативные массивы
            PDO::ATTR_EMULATE_PREPARES => false,                  // реальные подготовленные запросы
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo "Ошибка подключения: " . $this->error;
        }
    }

    // Метод для выполнения запросов
    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    // Метод для связывания параметров
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Метод для выполнения подготовленного запроса
    public function execute(array $params = [])
    {
        return $this->stmt->execute($params);
    }

    // Получаем все результаты
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Получаем одну запись
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Получаем количество строк
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}

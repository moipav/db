<?php

namespace Pavel\Db;

use PDO;
use PDOException;

class Databasee {
    private $host = 'localhost';  // адрес сервера
    private $db   = 'db';  // имя базы данных
    private $user = 'root';  // имя пользователя
    private $pass = '';  // пароль
    private $charset = 'utf8mb4';  // кодировка

    private $pdo;
    private $error;
    private $stmt;

    public function __construct() {
        // DSN строка для подключения
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // ошибки через исключения
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // по умолчанию ассоциативные массивы
            PDO::ATTR_EMULATE_PREPARES   => false,                  // реальные подготовленные запросы
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo "Ошибка подключения: " . $this->error;
        }
    }

    // Метод для выполнения запросов
    public function query($sql) {
        $this->stmt = $this->pdo->prepare($sql);
    }

    // Метод для связывания параметров
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true) {
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
    public function execute() {
        return $this->stmt->execute();
    }

    // Получаем все результаты
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Получаем одну запись
    public function single() {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Получаем количество строк
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}

<?php

    class Database {
        private static $instance = null;
        private $pdo;

        private function __construct()
        {
            include_once('./init.php');

            try {
                $dsn ="mysql:host=$host_name;dbname=$data_base_name";
                $username = $user_name;
                $password = $user_password;

                $this->pdo = new PDO($dsn, $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Ошибка подключения к базе данных: " . $e->getMessage();
                exit();
            }
        }

        public static function getInstance()
        {
            if (!self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function getConnection()
        {
            return $this->pdo;
        }
    }
?>
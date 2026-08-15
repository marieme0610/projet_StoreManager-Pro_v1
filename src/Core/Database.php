<?php

class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        try {
            
            $dsn = "pgsql:host=localhost;port=5432;dbname=erppostgres";

            $this->pdo = new PDO(
                $dsn,
                "postgres",
                1234
            );

        } catch (\PDOException $e) {

            $sqlitePath = dirname(__DIR__, 2) . "/database/erp.db";

            $this->pdo = new PDO(
                "sqlite:" . $sqlitePath
            );

            $this->pdo->exec("PRAGMA foreign_keys = ON;");
        }

        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        $this->pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnexion(): PDO
    {
        return $this->pdo;
    }

   
}
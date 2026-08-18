<?php

declare(strict_types=1);

class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        $dsn = "pgsql:host=localhost;port=5432;dbname=erppostgres";

        try {
            $this->pdo = new PDO($dsn, "postgres", "1234", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
            ]);
        } catch (PDOException $e) {
            $sqlitePath = dirname(__DIR__, 2) . "/schemaSql/erp.db";
            $this->pdo = new PDO("sqlite:" . $sqlitePath, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            $this->pdo->exec("PRAGMA foreign_keys = ON;");
        }
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

    public function query(string $sql, bool $single = true): array|false
    {
        $stmt = $this->pdo->query($sql);
        return $single ? $stmt->fetch() : $stmt->fetchAll();
    }

    public function prepare(string $sql, array $datas): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($datas);
        return $stmt;
    }


    public function executeQuery(string $sql, array $datas, bool $single = true): array|false
    {
        $stmt = $this->prepare($sql, $datas);
        return $single ? $stmt->fetch() : $stmt->fetchAll();
    }


    public function executeUpdate(string $sql, array $datas): int
    {
        $stmt = $this->prepare($sql, $datas);

        if (str_starts_with(strtoupper(trim($sql)), 'INSERT')) {
            return (int) $this->pdo->lastInsertId();
        }

        return $stmt->rowCount();
    }
}
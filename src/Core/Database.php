<?php

declare(strict_types=1);

class Database
{
    private static ?Database $instance = null;
    private static PDO $pdo;

    private function __construct()
    {
        $dsn = "pgsql:host=localhost;port=5432;dbname=erppostgres";

        try {
            self::$pdo = new PDO($dsn, "postgres", "1234", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
            ]);
        } catch (PDOException $e) {
            $sqlitePath = dirname(__DIR__, 2) . "/schemaSql/erp.db";
            self::$pdo = new PDO("sqlite:" . $sqlitePath, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            self::$pdo->exec("PRAGMA foreign_keys = ON;");
        }
    }

    private static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private static function getConnexion(): PDO
    {
        self::getInstance();
        return self::$pdo;
    }

    public static function query(string $sql, bool $single = true): array|false
    {
        $stmt = self::getConnexion()->query($sql);
        return $single ? $stmt->fetch() : $stmt->fetchAll();
    }

    public static function prepare(string $sql, array $datas): PDOStatement
    {
        $stmt = self::getConnexion()->prepare($sql);
        $stmt->execute($datas);
        return $stmt;
    }


    public static function executeQuery(string $sql, array $datas, bool $single = true): array|false
    {
        $stmt = self::prepare($sql, $datas);
        return $single ? $stmt->fetch() : $stmt->fetchAll();
    }


    public static function executeUpdate(string $sql, array $datas): int
    {
        $stmt = self::prepare($sql, $datas);

        if (str_starts_with(strtoupper(trim($sql)), 'INSERT')) {
            return (int) self::getConnexion()->lastInsertId();
        }

        return $stmt->rowCount();
    }
}
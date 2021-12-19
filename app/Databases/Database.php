<?php

namespace App\Databases;

use PDO;
use PDOException;

class Database
{
    private static string $host = getenv("DB_HOST");
    private static int $port = getenv("DB_PORT");
    private static string $dbname = getenv("DB_NAME");
    private static string $username = getenv("DB_USERNAME");
    private static string $password = getenv("DB_PASSWORD");

    private static ?PDO $pdo = null;
    private static $stmt;

    public function __construct()
    {
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            if (is_null(self::$pdo)) {
                $config = new DatabaseConfiguration(
                    self::$host,
                    self::$port,
                    self::$username,
                    self::$password,
                    self::$dbname,
                    $options
                );
                $connection = new DatabaseConnection($config);
                self::$pdo = $connection->getConnection();
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function beginTransaction()
    {
        self::$pdo->beginTransaction();
    }

    public static function commitTransaction()
    {
        self::$pdo->commit();
    }

    public static function rollbackTransaction()
    {
        self::$pdo->rollBack();
    }

    public static function query($query)
    {
        self::$stmt = self::$pdo->prepare($query);
    }

    public static function bind($param, $value, $type = null)
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

        self::$stmt->bindValue($param, $value, $type);
    }

    public static function execute()
    {
        self::$stmt->execute();
    }
}

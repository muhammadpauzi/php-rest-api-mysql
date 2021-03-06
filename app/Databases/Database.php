<?php

namespace App\Databases;

use PDO;

class Database
{
    private static string $host = DB_HOST;
    private static int $port = DB_PORT;
    private static string $dbname = DB_NAME;
    private static string $username = DB_USERNAME;
    private static string $password = DB_PASSWORD;

    private static PDO $connection;
    private static $stmt;

    public static function getDatabase()
    {
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $config = new DatabaseConfiguration(
            self::$host,
            self::$port,
            self::$username,
            self::$password,
            self::$dbname,
            $options
        );
        $connection = new DatabaseConnection($config);
        self::$connection = $connection->getConnection();
        return new self;
    }

    public static function beginTransaction()
    {
        self::$connection->beginTransaction();
    }

    public static function commitTransaction()
    {
        self::$connection->commit();
    }

    public static function rollbackTransaction()
    {
        self::$connection->rollBack();
    }

    public function query($query)
    {
        self::$stmt = self::$connection->prepare($query);
        return $this;
    }

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

        self::$stmt->bindValue($param, $value, $type);
        return $this;
    }

    public function execute()
    {
        self::$stmt->execute();
    }

    public function resultArray()
    {
        $this->execute();
        return self::$stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return self::$stmt->fetch(PDO::FETCH_ASSOC);
    }
}

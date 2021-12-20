<?php

namespace App\Databases;

use PDO;
use PDOException;

class DatabaseConnection
{
    private static ?PDO $pdo = null;
    private static DatabaseConfiguration $configuration;

    public function __construct(DatabaseConfiguration $configuration)
    {
        self::$configuration = $configuration;
    }

    public static function getDsn(): string
    {
        return "mysql:host=" . self::$configuration->getHost() . ";dbname=" . self::$configuration->getDBName();
    }

    public static function getConnection(): PDO
    {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new PDO(
                    self::getDsn(),
                    self::$configuration->getUsername(),
                    self::$configuration->getPassword(),
                    self::$configuration->getOptions()
                );;
                return self::$pdo;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

<?php

namespace App\Databases;

use PDO;

class DatabaseConnection
{
    public function __construct(private DatabaseConfiguration $configuration)
    {
    }

    public function getDsn(): string
    {
        return "mysql:host=" . $this->configuration->getHost() . ";dbname=" . $this->configuration->getDBName();
    }

    public function getConnection(): PDO
    {
        return new PDO(
            $this->getDsn(),
            $this->configuration->getUsername(),
            $this->configuration->getPassword(),
            $this->configuration->getOptions()
        );
    }
}

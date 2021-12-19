<?php

namespace App\Databases;

class DatabaseConfiguration
{
    public function __construct(
        private string $host,
        private int $post,
        private string $username,
        private string $password,
        private string $dbname,
        private array $options,
    ) {
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDBName(): string
    {
        return $this->dbname;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}

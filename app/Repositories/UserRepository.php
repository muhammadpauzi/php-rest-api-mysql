<?php

namespace App\Repositories;

use App\Databases\Database;

class UserRepository
{
    private string $table = "users";

    public function __construct(private Database $db)
    {
    }

    public function findAll(): array
    {
        return $this->db->query("SELECT * FROM $this->table")->resultArray();
    }

    public function findById(int $id): array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE id = :id LIMIT 1")->bind(":id", $id)->resultArray();
    }
}

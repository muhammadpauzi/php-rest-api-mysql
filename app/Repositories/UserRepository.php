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
}

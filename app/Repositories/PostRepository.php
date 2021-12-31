<?php

namespace App\Repositories;

use App\Databases\Database;

class PostRepository
{
    private string $table = "posts";

    public function __construct(private Database $db)
    {
    }

    public function findAll(): array
    {
        return $this->db->query("SELECT * FROM $this->table JOIN users ON (users.id = $this->table.id_user)")->resultArray();
    }

    public function findAllBySearchKeyword(string $search_keyword = ""): array
    {
        return $this->db->query("SELECT * FROM $this->table  JOIN users ON (users.id = $this->table.id_user) WHERE MATCH(title, description) AGAINST(:keyword IN NATURAL LANGUAGE MODE);")->bind(":keyword", $search_keyword)->resultArray();
    }

    public function findById(int $id): array
    {
        return $this->db->query("SELECT * FROM $this->table JOIN users ON (users.id = $this->table.id_user) WHERE $this->table.id = :id LIMIT 1")->bind(":id", $id)->single();
    }

    public function findAllByUserID(int $id): array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE id_user = :id")->bind(":id", $id)->resultArray();
    }
}

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
        return $this->db->query("SELECT * FROM $this->table")->resultArray();
    }

    public function findAllBySearchKeyword(string $search_keyword = ""): array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE MATCH(title, description) AGAINST(:keyword IN NATURAL LANGUAGE MODE);")->bind(":keyword", $search_keyword)->resultArray();
    }

    public function findById(int $id): array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE id = :id LIMIT 1")->bind(":id", $id)->resultArray();
    }

    public function findAllByID(int $id): array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE id = :id")->bind(":id", $id)->resultArray();
    }
}

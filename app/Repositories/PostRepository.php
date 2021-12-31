<?php

namespace App\Repositories;

use App\Databases\Database;

class PostRepository
{
    private string $table = "posts";

    public function __construct(private Database $db)
    {
    }

    public function findAll(int $offset, int $limit, string $sort): array
    {
        return $this->db->query("SELECT *, users.created_at AS user_created_at, $this->table.id AS id FROM $this->table JOIN users ON (users.id = $this->table.id_user) ORDER BY $this->table.created_at $sort LIMIT :limit OFFSET :offset")->bind(":limit", $limit)->bind(":offset", $offset)->resultArray();
    }

    public function findAllBySearchKeyword(string $search_keyword, int $offset, int $limit, string $sort): array
    {
        return $this->db->query("SELECT *, users.created_at AS user_created_at, users.id AS id_user FROM $this->table  JOIN users ON (users.id = $this->table.id_user) WHERE MATCH(title, description) AGAINST(:keyword IN NATURAL LANGUAGE MODE) ORDER BY $this->table.created_at $sort LIMIT :limit OFFSET :offset")->bind(":limit", $limit)->bind(":offset", $offset)->bind(":keyword", $search_keyword)->resultArray();
    }

    public function findById(int $id): array
    {
        return $this->db->query("SELECT *, users.created_at AS user_created_at FROM $this->table JOIN users ON (users.id = $this->table.id_user) WHERE $this->table.id = :id LIMIT 1")->bind(":id", $id)->single();
    }

    public function findAllByUserID(int $id): array
    {
        return $this->db->query("SELECT * FROM $this->table WHERE id_user = :id")->bind(":id", $id)->resultArray();
    }
}

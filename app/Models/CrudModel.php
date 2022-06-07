<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CrudModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = &$db;
    }

    public function getItem(string $table, array $params = [], array $order = []): array
    {

        $builder = $this->db->table($table);

        foreach ($params as $key => $value) {
            $builder->where($key, $value);
        }

        foreach ($order as $key => $date) {
            $builder->orderBy($key, $date);
        }

        return $builder->get()->getResult();
    }

    public function updateTable(string $table, array $params, array $where)
    {
        $builder = $this->db->table($table);

        foreach ($where as  $key => $value) {
            $builder->where($key, $value);
        }

        $builder->update($params);
    }
    public function insertItem(array $params, string $table): int
    {
        $builder = $this->db->table($table);
        $builder->insert($params);
        return $this->db->connID->insert_id;
    }
}

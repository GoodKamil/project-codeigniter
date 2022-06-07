<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    public function createUser(array $params): int
    {
        $builder = $this->db->table('UsersList');
        $builder->insert($params);
        return $this->db->connID->insert_id;
    }

    public function getUser(array $params): array
    {
        $builder = $this->db->table('UsersList');
        return $builder->where($params)->get(1)->getResult();
    }


    public function lastConnect(array $params)
    {
        $set = ['lastConnect' => date('Y-m-d H:i:s')];
        $builder = $this->db->table('UsersList');
        $builder->update($set, $params);
    }
    public function updateDate(array $set,array $where): bool
    {
        $builder = $this->db->table('UsersList');
        $builder->update($set, $where);
        return $builder->countAll();
    }

    public function insertNumberAccount(array $params)
    {
        $builder = $this->db->table('numberaccount');
        $builder->insert($params);
    }
}

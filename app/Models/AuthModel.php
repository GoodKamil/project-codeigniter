<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function createUser(array $params): bool
    {
        $builder = $this->db->table('UsersList');
        $builder->insert($params);
        return $builder->countAll();
    }

    public function getUser(array $params): array
    {
        $builder = $this->db->table('UsersList');
        $result = $builder->where($params)->get(1)->getResult();
        return $result;
    }


    public function lastConnect(array $params)
    {
        $set = ['lastConnect' => date('Y-m-d H:i:s')];
        $builder = $this->db->table('UsersList');
        $builder->update($set, $params);
    }
    public function updateDate(array $set): bool
    {
        $where = ['id_U' => session()->get('id_U')];
        $builder = $this->db->table('UsersList');
        $builder->update($set, $where);
        return $builder->countAll();
    }
}

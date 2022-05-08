<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function getMessages(array $params = []): array
    {
        $builder = $this->db->table('messages');
        if ($params) {

            foreach ($params as $key => $value) {
                $builder->where($key, $value);
            }

            $result = $builder->get()->getResult();
        } else
            $result = $builder->get()->getResult();


        return $result;
    }

    public function updateTable(array $params, array $where, string $table)
    {
        $builder = $this->db->table($table);
        $builder->update($params, $where);
    }
}

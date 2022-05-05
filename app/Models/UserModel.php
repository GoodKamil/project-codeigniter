<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }


    public function getAccountUser(string $idUser): array
    {
        $builder = $this->db->table('numberaccount');
        $result = $builder->where('id_U', $idUser)->get()->getResult();
        return $result;
    }
    public function insertTransfer(array $params)
    {
        $builder = $this->db->table('transfer');
        $builder->insert($params);
    }

    public function getHistory(string $idUser): array
    {
        $builder = $this->db->table('transfer');
        $builder->join('numberaccount', 'numberaccount.id_N=transfer.transferFrom or numberaccount.id_N=transfer.transferTo');
        $result = $builder->where('numberaccount.id_U', $idUser)->get()->getResult();
        return $result;
    }
}

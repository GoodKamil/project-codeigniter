<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = &$db;
    }


    public function getAccountUser(string $param, string $column): array
    {
        $builder = $this->db->table('numberaccount');
        return $builder->where($column, $param)->get()->getResult();
    }
    public function insertDB(array $params, string $table)
    {
        $builder = $this->db->table($table);
        $builder->insert($params);
    }

    public function getHistory(string $idUser): array
    {
        $builder = $this->db->table('transfer');
        $builder->distinct()->join('numberaccount', 'numberaccount.id_N=transfer.transferFrom or numberaccount.id_N=transfer.transferTo');
        $result = $builder->where('numberaccount.id_U', $idUser)->orderBy('id_T', 'desc')->get()->getResult();
        return $result;
    }

    public function transferNumberAccount(int $number)
    {
        $builder = $this->db->table('transfer');
        $result = $builder->where('transferFrom', $number)->orWhere('transferTo', $number)->get()->getResult();
        return $result;
    }

    public function getTransfer(int $idTransfer): array
    {
        $builder = $this->db->table('transfer');
        return $builder->where('id_T', $idTransfer)->get()->getResult();
    }

    public function getMessages(array $params = []): array
    {
        $builder = $this->db->table('messages');
        if ($params) {
            foreach ($params as $key => $value) {
                $builder->where($key, $value);
            }
        }

        return $builder->get()->getResult();
    }

    public function getHistoryAjax(string $idUser, array $params): array
    {
        $builder = $this->db->table('transfer');
        $builder->distinct()->join('numberaccount', 'numberaccount.id_N=transfer.transferFrom or numberaccount.id_N=transfer.transferTo');
        $builder->where('numberaccount.id_U', $idUser);
        foreach ($params as $key => $value) {
            $builder->where($key, $value);
        }

        return $builder->orderBy('transferDate', 'desc')->get()->getResult();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ValidationModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function is_key(string $key, string $username): bool
    {
        $builder = $this->db->table('UsersList');
        $isKey = $builder->where('KeyLogin', $key)->where('Email', $username)->get()->getResult();

        if ($isKey)
            return true;

        return false;
    }

    public function validUser(string $username, string $password): bool
    {
        $builder = $this->db->table('UsersList');
        $user = $builder->where('Email', $username)->get()->getResult();
        if (!$user) {
            return false;
        } else
            return password_verify($password, $user[0]->Password);
    }

    public function checkNumberAccount($accountNumber): bool
    {
        $builder = $this->db->table('numberaccount');
        $result = $builder->where('number', $accountNumber)->get()->getResult();
        if ($result) {
            foreach ($result as $key => $value) {
                session()->set('isNumber', $value->id_N);
            }
            return true;
        }
        return false;
    }
}

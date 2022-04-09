<?php

namespace App\Validation;

use App\Models\ValidationModel;

class AuthValidation
{
    protected $db;
    public function __construct()
    {
        $base = db_connect();
        $this->db = new ValidationModel($base);
    }

    public function validUser(string $str, string $fields, array $data): bool
    {
        return $this->db->validUser($data['emailLogin'], $data['passwordLogin']);
    }

    public function is_key(string $str, string $fields, array $data): bool
    {
        return $this->db->is_key($data['loginKey'], $data['emailLogin']);
    }
}

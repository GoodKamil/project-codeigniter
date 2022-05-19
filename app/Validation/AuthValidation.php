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

    public function checkBlock(string $str, string $fields, array $data): bool
    {
        $result = $this->db->getItem(['Email' => $data['emailLogin']], 'UsersList');
        if ($result[0]->block == '1')
            return false;

        return true;
    }

    public function is_key(string $str, string $fields, array $data): bool
    {
        return $this->db->is_key($data['loginKey'], $data['emailLogin']);
    }
    public function validPrice(string $str, string $fields, array $data): bool
    {
        if ($data['price'] > 0)
            return true;
        else
            return false;
    }

    public function validPriceAccount(string $str, string $fields, array $data): bool
    {
        if ($data['priceSource'] <= 0)
            return false;

        return true;
    }

    public function validPriceAccountWithPrice(string $str, string $fields, array $data): bool
    {


        if ($data['priceSource'] < $data['price'])
            return false;

        return true;
    }


    public function validNumberAccount(string $str, string $fields, array $data): bool
    {
        $number = substr($data['numberAccount'], 2, 4);

        if ($number !== $data['nameBank'])
            return false;

        if ($data['nameBank'] == '2510') {
            if ($number == '2510')
                return $this->db->checkNumberAccount($data['numberAccount']);
            else
                return false;
        }
        return true;
    }

    public function validDate(string $str, string $fields, array $data): bool
    {
        if ($data['dateProblems'] > date('Y-m-d'))
            return false;

        return true;
    }
}

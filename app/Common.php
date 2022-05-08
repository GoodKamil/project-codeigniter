<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter4.github.io/CodeIgniter4/
 */

use App\Models\UserModel;
use App\Models\AuthModel;
use App\Models\EmployeeModel;

if (!function_exists('GetBank')) {
    /**
     * 
     * Nazwy i numery banków
     *
     */
    function GetBank()
    {
        return
            [
                '1010' => 'Narodowy Bank Polski',
                '1020' => 'PKO BP',
                '1030' => 'Bank Handlowy (Citi Handlowy)',
                '1050' => 'ING Bank Śląski',
                '1090' => 'Santander Bank Polska',
                '1130' => 'BGK',
                '1160' => 'Bank Millennium',
                '1240' => 'Pekao SA',
                '2490' => 'Alior Bank, T-Mobile Usługi Bankowe',
                '1930' => 'Bank Polskiej Spółdzielczości',
                '2510' => 'Bank Wielkopolski'
            ];
    }
}

if (!function_exists('GetNameBank')) {
    /**
     * 
     * Pobranie nazwy banku po numerze 
     *
     */
    function GetNameBank(int $numer)
    {
        $bank = GetBank();
        foreach ($bank as $key => $value) {
            if ($key === $numer)
                return $value;
        }
    }
}

if (!function_exists('GetAccount')) {
    /**
     * 
     * Pobranie numeru konta bankowego na podstawie ID
     *
     */

    function GetAccount(string $numer, string $column, string $search = 'id_N')
    {

        $db = db_connect();
        $dbUser = new UserModel($db);
        $result = $dbUser->getAccountUser($numer, $search);
        return $result[0]->$column ??  $numer;
    }
}

if (!function_exists('GetUser')) {
    /**
     * 
     * Pobranie danych o użytkowniku na  podstawie numeru konta
     *
     */

    function GetUser(string $numer)
    {

        $id = GetAccount($numer, 'id_U');
        $db = db_connect();
        $dbAuth = new AuthModel($db);
        $result = $dbAuth->getUser(['id_U' => $id]);
        return $result[0]->FirstName . ' ' . $result[0]->LastName ?? 'Brak danych o nadawcy';
    }
}

if (!function_exists('GetUserID')) {
    /**
     * 
     * Pobranie danych o użytkowniku na podstawie ID
     *
     */

    function GetUserID(string $id)
    {

        $db = db_connect();
        $dbAuth = new AuthModel($db);
        $result = $dbAuth->getUser(['id_U' => $id]);
        return $result[0]->FirstName . ' ' . $result[0]->LastName ?? 'Brak danych o kliencie';
    }
}


if (!function_exists('CreateNumberAccount')) {
    /**
     * 
     * Generator numeru bankowego
     *
     */
    function CreateNumberAccount(): string
    {
        $numberAccount = '';


        for ($x = 0; $x < 2; $x++) {
            $numberAccount .= rand(0, 9);
        }
        $numberAccount .= '25100290';

        for ($x = 0; $x < 16; $x++) {
            $numberAccount .= rand(0, 9);
        }

        return $numberAccount;
    }
}

if (!function_exists('GetStatus')) {
    /**
     * 
     * Pobranie statusów lub statusu wiadomości
     *
     */
    function GetStatus(int $idStatus = 0): array|string
    {

        $status = [
            '1' => 'Wiadomość czeka na weryfikację przez pracownika',
            '2' => 'Wiadomość przyjęta',
            '3' => 'Wiadomość odrzucona',
        ];
        if (key_exists($idStatus, $status)) {
            return $status[$idStatus];
        }

        return $status;
    }
}

if (!function_exists('WaitingNews')) {
    /**
     * 
     * Pobranie statusów lub statusu wiadomości
     *
     */
    function WaitingNews(): int
    {
        $db = db_connect();
        $dbEmployee = new EmployeeModel($db);
        $result = $dbEmployee->getMessages(['status' => '1']);
        return count($result);
    }
}

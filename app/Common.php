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

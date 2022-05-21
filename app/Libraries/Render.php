<?php

namespace App\Libraries;


class Render
{
    private $permission;
    public function __construct()
    {
        $this->permission = session()->get('permissions');
    }

    public function renderMenu()
    {
        $view = '';
        if ($this->permission == '1')
            $view = 'Users';
        else if ($this->permission == '5')
            $view = 'Employee';
        else
            $view = 'Admin';

        return view($view . '/menu' . $view);
    }
}

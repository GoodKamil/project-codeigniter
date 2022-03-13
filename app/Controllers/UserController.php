<?php

namespace App\Controllers;

class UserController extends BaseController
{

    public function index()
    {
        if (!session()->get('logged'))
            return view('login');

        return view('Users/main');
    }


    public function Transfer()
    {
        return view('Users/transfer');
    }
}

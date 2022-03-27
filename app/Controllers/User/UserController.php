<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserController extends BaseController
{

    public function index()
    {
        return view('Users/dashboard');
    }

    public function Transfer()
    {
        return view('Users/transfer');
    }
}

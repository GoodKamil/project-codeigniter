<?php

namespace App\Controllers;

class AccountController extends BaseController
{
    public function createAccount()
    {
        return view('register');
    }

    public function LoginUser()
    {
        if ($this->request->getMethod() == 'post') {
        }
        session()->set('logged', 'true');
        return view('Users/main');
    }
    public function Logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

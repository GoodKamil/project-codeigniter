<?php

namespace App\Controllers;

class AuthController extends BaseController
{

    public function index()
    {
        if (!session()->get('logged'))
            return view('login');

        return view('Users/main');
    }

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

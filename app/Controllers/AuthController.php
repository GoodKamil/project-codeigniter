<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $base = db_connect();
        $this->db = new AuthModel($base);
    }
    public function index()
    {
        return view('login');
    }

    public function createAccount()
    {
        if ($this->request->getMethod() == 'post') {


            $check = [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => [
                    'rules' => 'required|valid_email|is_unique[Email.email]',
                    'errors' => [
                        'valid_email' => 'Niepoprawny adres e-mail',
                        'is_unique' => 'Użytkownik o takim adresie e-mail już istnieje'
                    ],
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'min_length' => 'Hasło musi składać sie z minumium 8 znaków'
                    ]
                ],
                'RepeatPassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'matches' => 'Hasła róznią sie od siebie'
                    ]
                ],
                'Key' => [
                    'rules' => 'required|numeric|is_unique[KeyLogin.Key]|exact_length[6]',
                    'errors' => [
                        'numeric' => 'Warość klucza musi być liczbowa',
                        'is_unique' => 'Wartość klucza już istnieje',
                        'exact_length' => 'Klucz powinien składać sie z 6 liczb'
                    ]
                ],
                'phone' => [
                    'rules' => 'required|numeric|exact_length[9]',
                    'errors' => [
                        'numeric' => 'Numer telefonu musi składać sie z liczb',
                        'exact_length' => 'Numer telefonu powinien składać sie z 9 liczb'
                    ]
                ]
            ];

            $params = [
                'FirstName' => $this->request->getPost('firstname'),
                'LastName' => $this->request->getPost('lastname'),
                'Email' => $this->request->getPost('email'),
                'NumberPhone' => $this->request->getPost('phone'),
                'KeyLogin' => $this->request->getPost('Key'),
                'Password' => $this->hashPassword($this->request->getPost('password'))
            ];

            print_r($params);
        }
        return view('register');
    }

    public function LoginUser()
    {

        if ($this->request->getMethod() == 'post') {

            session()->set('isLoggedIn', 'true');
        }
        return redirect()->to('dashboard');
    }
    public function Logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

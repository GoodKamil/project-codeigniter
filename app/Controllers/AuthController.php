<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController extends BaseController
{
    protected $db;
    protected $data;

    public function __construct()
    {
        $base = db_connect();
        $this->db = new AuthModel($base);
        helper('form');
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
                    'rules' => 'required|valid_email|is_unique[UsersList.Email]',
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
                    'rules' => 'required|numeric|is_unique[UsersList.KeyLogin]|exact_length[6]',
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

            if (!$this->validate($check)) {
                $this->data['validation'] = $this->validator;
                return view('register', $this->data);
            }

            $params = [
                'FirstName' => htmlentities($this->request->getPost('firstname')),
                'LastName' =>  htmlentities($this->request->getPost('lastname')),
                'Email' => htmlentities($this->request->getPost('email')),
                'NumberPhone' => $this->request->getPost('phone'),
                'KeyLogin' => $this->request->getPost('Key'),
                'Password' => $this->hashPassword(htmlentities($this->request->getPost('password'))),
                'NumberAccount' => $this->createNumberAcount(),
                'created' => date('Y-m-d'),
                'permissions' => 1

            ];
            $result = $this->db->createUser($params);
            if ($result) {
                session()->setFlashdata('successInsert', 'true');
                return view('login');
            } else {
                session()->setFlashdata('errorInsert', 'true');
                return view('register');
            }
        }

        return view('register');
    }

    public function LoginUser()
    {

        if ($this->request->getMethod() == 'post') {
            $checkVali = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'valid_email' => 'Niepoprawny adres e-mail'
                    ]

                ],
                'password' => [
                    'rules' => 'min_length[8]|validUser[email,password]',
                    'errors' => [
                        'min_length' => 'Hasło musi składać sie z minumium 8 znaków',
                        'validUser' => 'Nieprawidłowe dane użytkownika'
                    ]
                ],
                'loginKey' => [
                    'rules' => 'required|numeric|exact_length[6]|is_key[loginKey,email]',
                    'errors' => [
                        'numeric' => 'Wartość klucza musi być liczbowa',
                        'exact_length' => 'Klucz powinien składać sie z 6 liczb',
                        'is_key' => 'Nieprawidłowa warość klucza'
                    ]
                ]

            ];
            if (!$this->validate($checkVali)) {
                $this->data['validation'] = $this->validator;
                return view('login', $this->data);
            }
            $params = [
                'Email' => htmlentities($this->request->getPost('email')),
                'KeyLogin' => htmlentities($this->request->getPost('loginKey')),
            ];
            $user = $this->db->getUser($params);
            $this->db->lastConnect($params);
            $sessionArray = [
                'isLoggedIn' => true,
                'permissions' => $user[0]->permissions,
                'id_U' => $user[0]->id_U
            ];
            session()->set($sessionArray);
            return redirect()->to('dashboard');
        }

        redirect()->to('/');
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

    public function createNumberAcount(): string
    {
        $numberAccount = '';


        for ($x = 0; $x < 2; $x++) {
            $numberAccount .= rand(0, 9);
        }
        $numberAccount .= '21200290';

        for ($x = 0; $x < 16; $x++) {
            $numberAccount .= rand(0, 9);
        }

        return $numberAccount;
    }
}

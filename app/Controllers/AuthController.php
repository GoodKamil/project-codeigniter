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
                    'rules' => 'required',
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
                    'rules' => 'required|exact_length[9]',
                    'errors' => [
                        'exact_length' => 'Numer telefonu powinien składać sie z 9 liczb'
                    ]
                ]
            ];

            if (!$this->validate($check)) {
                $this->data['validation'] = $this->validator;
                return view('register', $this->data);
            }

            $params = [
                'FirstName' => $this->request->getPost('firstname'),
                'LastName' =>  $this->request->getPost('lastname'),
                'Email' => $this->request->getPost('email'),
                'NumberPhone' => $this->request->getPost('phone'),
                'KeyLogin' => $this->request->getPost('Key'),
                'Password' => $this->hashPassword($this->request->getPost('password')),
                'created' => date('Y-m-d'),
                'permissions' => 1

            ];
            $result = $this->db->createUser($params);
            if ($result) {
                $params2 = [
                    'number' => CreateNumberAccount(),
                    'id_U' => $result
                ];
                $this->db->insertNumberAccount($params2);
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
                'emailLogin' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'valid_email' => 'Niepoprawny adres e-mail'
                    ]

                ],
                'passwordLogin' => [
                    'rules' => 'required|validUser[emailLogin,passwordLogin]|checkBlock[emailLogin]',
                    'errors' => [
                        'validUser' => 'Nieprawidłowe dane użytkownika',
                        'checkBlock' => 'Twoje konto zostało zablokowane,prosimy skontaktować się z działem obsługi'
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
                'Email' => $this->request->getPost('emailLogin'),
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
            if ($user[0]->permissions === '1')
                return redirect()->to('HomeUser');
            else if ($user[0]->permissions === '5 ')
                return redirect()->to('messages');
            else
                return redirect()->to('viewGroup/ShowKlient');
        }

        return redirect()->to('/');
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

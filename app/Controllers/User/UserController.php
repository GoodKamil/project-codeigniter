<?php

namespace App\Controllers\User;

use App\Models\AuthModel;
use App\Controllers\BaseController;

class UserController extends BaseController
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
        return view('Users/dashboard');
    }

    public function Transfer()
    {
        $this->data['tableBank'] = GetBank();
        return view('Users/transfer', $this->data);
    }

    public function Settings()
    {
        $this->data['user'] = $this->db->getUser(['id_U' => session()->get('id_U')]);
        return view('Users/settings', $this->data);
    }
    public function editUser()
    {
        $this->data['user'] = $this->db->getUser(['id_U' => session()->get('id_U')]);

        if ($this->request->getMethod() == 'post') {
            $email = $this->data['user'][0]->Email;
            $checkValid = [
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => [
                    'rules' => 'required|numeric|exact_length[9]',
                    'errors' => [
                        'numeric' => 'Numer telefonu musi składać sie z liczb',
                        'exact_length' => 'Numer telefonu powinien składać sie z 9 liczb'
                    ]
                ]
            ];
            if ($this->request->getPost('email') !== $email)
                $checkValid += [
                    'email' => [
                        'rules' => 'required|valid_email|is_unique[UsersList.Email]',
                        'errors' => [
                            'valid_email' => 'Niepoprawny adres e-mail',
                            'is_unique' => 'Użytkownik o takim adresie e-mail już istnieje'
                        ],
                    ],
                ];

            if (!$this->validate($checkValid)) {
                $this->data['validation'] = $this->validator;
                return view('Users/editUser', $this->data);
            }

            $params = [
                'FirstName' => htmlentities($this->request->getPost('firstname')),
                'LastName' => htmlentities($this->request->getPost('lastname')),
                'NumberPhone' => $this->request->getPost('phone'),
                'Email' => htmlentities($this->request->getPost('email'))
            ];
            $isUpdate = $this->db->updateDate($params);
            if ($isUpdate) {
                session()->setFlashdata('successUpdate', 'true');
                return  redirect()->to('Settings');
            } else {
                session()->setFlashdata('errorUpdate', 'true');
                return view('Users/editUser', $this->data);
            }
        }


        return view('Users/editUser', $this->data);
    }

    public function viewHistory()
    {
        return view('Users/viewHistory');
    }

    public function viewHistoryOne(int $id)
    {
        return view('Users/viewHistoryOne');
    }
}

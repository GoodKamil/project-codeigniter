<?php

namespace App\Controllers\User;

use App\Models\AuthModel;
use App\Models\UserModel;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $db;
    protected $data;
    protected $dbUser;
    protected $id_U;

    public function __construct()
    {
        $base = db_connect();
        $this->db = new AuthModel($base);
        $this->dbUser = new UserModel($base);
        $this->id_U = session()->get('id_U');
        helper('form');
    }
    public function index()
    {
        return view('Users/dashboard');
    }

    public function Transfer($validation = '')
    {
        $this->data['tableBank'] = GetBank();
        $this->data['numberAccount'] = $this->dbUser->getAccountUser($this->id_U);
        if ($validation) {
            $this->data['validation'] = $this->validator;
        }
        return view('Users/transfer', $this->data);
    }

    public function Settings()
    {
        $this->data['user'] = $this->db->getUser(['id_U' => $this->id_U]);
        return view('Users/settings', $this->data);
    }
    public function editUser()
    {
        $this->data['user'] = $this->db->getUser(['id_U' => $this->id_U]);

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
        $this->data['history'] = $this->dbUser->getHistory($this->id_U);
        $this->data['numberAccount'] = $this->dbUser->getAccountUser($this->id_U);
        return view('Users/viewHistory', $this->data);
    }

    public function viewHistoryOne(int $id)
    {
        return view('Users/viewHistoryOne');
    }

    public function TransferBank()
    {
        if ($this->request->getMethod() === 'post') {
            $checkValid = [
                'account_you' => 'required',
                'address' => 'required',
                'numberAccount' => [
                    'rules' => 'required|exact_length[26]|numeric|validNumberAccount[numberAccount,nameBank]',
                    'errors' => [
                        'exact_length' => 'Numer konta powinien składać sie z 26 cyfr',
                        'numeric' => 'Numer konta powinien składać sie z cyfr',
                        'numberAccount' => 'Numer konta naszego banku jest nieprawidłowy'
                    ]
                ],
                'price' => [
                    'rules' => 'required|numeric|validPrice[price]',
                    'errors' => [
                        'numeric' => 'kwota musie składać sie z cyfr',
                        'validPrice' => 'Kwota powinna byc większa od zera'
                    ]
                ],
                'description' => [
                    'rules' => 'required|min_length[7]',
                    'errors' => [
                        'min_length' => 'Tytuł przelewu powinien składać sie minimum z 7 znaków'
                    ],
                ]
            ];
            if (!$this->validate($checkValid)) {
                return $this->Transfer($this->validator);
            }

            $params = [
                'TransferFrom' => $this->request->getPost('account_you'),
                'adresO' => $this->request->getPost('address'),
                'TransferTo' => session()->get('isNumber') ? session()->get('isNumber') : $this->request->getPost('numberAccount'),
                'nameBank' => GetNameBank((int)$this->request->getPost('nameBank')),
                'price' => $this->request->getPost('price'),
                'title' => $this->request->getPost('description'),
                'transferDate' => $this->request->getPost('dataTransfer'),
            ];

            $this->dbUser->insertTransfer($params);
            session()->setFlashdata('successInsert', 'true');

            if (session()->get('isNumber'))
                session()->remove('isNumber');

            return $this->Transfer();
        }
    }
}

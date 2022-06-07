<?php

namespace App\Controllers\Admin;

use App\Models\CrudModel;
use App\Controllers\BaseController;

class AdminController extends BaseController
{
    protected $db;
    public $data = [];
    protected  $id_U;

    public function __construct()
    {
        $base = db_connect();
        $this->db = new CrudModel($base);
        $this->id_U = session()->get('id_U');
        helper('form');
    }
    public function index()
    {
        $params = ['permissions' => 1];
        $this->data['result'] = $this->db->getItem('userslist', $params);
        return view('Admin/viewGroup', $this->data);
    }

    public function blockUser(int $id, string $block)
    {
        $block = $block === 'block' ? 1 : 0;

        $params = ['block' => $block];
        $this->db->updateTable('userslist', $params, ['id_U' => $id]);

        return $this->index('ShowKlient');
    }

    public function addEmployee()
    {

        if ($this->request->getMethod() == 'post') {
            $checkVali = [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => [
                    'rules' => 'required|valid_email|is_unique[Userslist.Email]',
                    'errors' => [
                        'valid_email' => 'Niepoprawny adres e-mail',
                        'is_unique' => 'Osoba o takim adresie e-mail znajduje sie w systemie'
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

            if (!$this->validate($checkVali)) {
                $this->data['validation'] = $this->validator;
            } else {
                $firstName = trim(htmlentities($this->request->getPost('firstname')));
                $lastName = trim(htmlentities($this->request->getPost('lastname')));
                $password = $firstName[0] . '' . $lastName;
                $params = [
                    'FirstName' => $firstName,
                    'LastName' =>  $lastName,
                    'Email' => $this->request->getPost('email'),
                    'NumberPhone' => $this->request->getPost('phone'),
                    'KeyLogin' => $this->request->getPost('Key'),
                    'Password' => password_hash($password, PASSWORD_DEFAULT),
                    'created' => date('Y-m-d'),
                    'permissions' => 5

                ];

                $id = $this->db->insertItem($params, 'UsersList');
                if ($id)
                    session()->setFlashdata('successInsert', 'true');
                else
                    session()->setFlashdata('errorInsert', 'true');
            }
        }

        return view('Admin/addEmployee', $this->data);
    }

    public function getListGroups()
    {
        $show = $this->request->getGet('show');
        $param = ['permissions' => $show == 'ShowEmployee' ? 5 : 1];
        $result = $this->db->getItem('userslist', $param);
        return json_encode([
            'params' => $result,
            'show' => $show == 'ShowEmployee' ? 'ShowUsers' : 'ShowEmployee',
            'text' => $show == 'ShowEmployee' ? 'Pokaż użytkowników' : 'Pokaż pracowników'
        ]);
    }
}

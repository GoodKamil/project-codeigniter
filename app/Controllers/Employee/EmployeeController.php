<?php

namespace App\Controllers\Employee;

use App\Models\AuthModel;
use App\Models\EmployeeModel;
use App\Controllers\BaseController;

class EmployeeController extends BaseController
{
    protected $db;
    protected $data = [];
    protected $dbEmployee;
    protected $id_U;

    public function __construct()
    {
        $base = db_connect();
        $this->db = new AuthModel($base);
        $this->dbEmployee = new EmployeeModel($base);
        $this->id_U = session()->get('id_U');
        helper('form');
    }
    public function index()
    {
        return view('Users/dashboard');
    }

    public function messages()
    {
        $this->data['messages'] = $this->dbEmployee->getMessages();
        return view('Employee/messages', $this->data);
    }

    public function viewMessage(int $idM)
    {

        if ($this->request->getMethod() == 'post') {
            if ($this->request->getPost('status') == '1') {
                $params = [
                    'employeeComment' => NULL,
                    'status' => htmlentities($this->request->getPost('status')),
                    'id_E' => 0
                ];

                $this->dbEmployee->updateTable($params, ['id_M' => $idM], ' messages');
                session()->setFlashdata('successUpdate', 'true');
                return $this->messages();
            } else {
                $checkValid = [
                    'addComent' => 'required',
                    'status' => 'required'
                ];
                if (!$this->validate($checkValid)) {
                    $this->data['validation'] = $this->validator;
                } else {
                    $params = [
                        'employeeComment' => htmlentities($this->request->getPost('addComent')),
                        'status' => htmlentities($this->request->getPost('status')),
                        'id_E' => $this->id_U
                    ];

                    $this->dbEmployee->updateTable($params, ['id_M' => $idM], ' messages');
                    session()->setFlashdata('successUpdate', 'true');
                    return $this->messages();
                }
            }
        }

        $this->data['message'] = $this->dbEmployee->getMessages(['id_M' => $idM]);
        $this->data['status'] = GetStatus();
        return view('Employee/viewMessage', $this->data);
    }
}

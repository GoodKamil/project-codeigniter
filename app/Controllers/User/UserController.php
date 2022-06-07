<?php

namespace App\Controllers\User;

use App\Models\AuthModel;
use App\Models\UserModel;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $db;
    protected $data = [];
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
        if ($validation) {
            $this->data['validation'] = $this->validator;
        }
        $params = $this->getNumberAccountAndPrice();
        $this->data['numberAccount'] = $params['numberAccount'];
        $this->data['priceOneAccount'] = $params['price'];

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
            $isUpdate = $this->db->updateDate($params,['id_U' => session()->get('id_U')]);
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
        $this->data['numberAccount'] = $this->dbUser->getAccountUser($this->id_U, 'id_U');
        $this->data['status'] = GetStatus();
        return view('Users/viewHistory', $this->data);
    }

    public function viewHistoryOne(int $id)
    {
        $this->data['transfer'] = $this->dbUser->getTransfer($id);
        return view('Users/viewHistoryOne', $this->data);
    }

    public function TransferBank()
    {
        if ($this->request->getMethod() === 'post') {
            $checkValid = [
                'account_you' => 'required',
                'priceSource' => [
                    'rules' => 'required|validPriceAccount[priceSource]|validPriceAccountWithPrice[priceSource,price]',
                    'errors' => [
                        'validPriceAccount' => 'Brak srodków na koncie',
                        'validPriceAccountWithPrice' => 'Niewystarczająca ilość środków na koncie'
                    ]
                ],
                'address' => 'required',
                'numberAccount' => [
                    'rules' => 'required|exact_length[26]|numeric|validNumberAccount[numberAccount,nameBank]',
                    'errors' => [
                        'exact_length' => 'Numer konta powinien składać sie z 26 cyfr',
                        'numeric' => 'Numer konta powinien składać sie z cyfr',
                        'validNumberAccount' => 'Nieprawidłowy numer banku'
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

            $this->dbUser->insertDB($params, 'transfer');
            session()->setFlashdata('successInsert', 'true');

            if (session()->get('isNumber'))
                session()->remove('isNumber');

            return $this->Transfer();
        }
    }

    public function getNumberAccountAndPrice():array
    {
        $numberAccount = $this->dbUser->getAccountUser($this->id_U, 'id_U');
        $transferAccount = $this->dbUser->transferNumberAccount($numberAccount[0]->id_N);
        $price = $this->countTheAmount($transferAccount, $numberAccount[0]->id_N);

        return ['price' => $price, 'numberAccount' => $numberAccount];
    }

    public function HomeUser()
    {
        $params = $this->getNumberAccountAndPrice();
        $this->data['price'] = $params['price'];
        $this->data['numberAccount'] = $params['numberAccount'];
        return view('Users/home', $this->data);
    }
    public function addAccount()
    {
        $numberAccount = $this->dbUser->getAccountUser($this->id_U, 'id_U');
        if (count($numberAccount) === 2) {
            session()->setFlashdata('errorAccount', 'true');
            return $this->HomeUser();
        }

        $params = [
            'id_U' => $this->id_U,
            'number' => CreateNumberAccount(),
        ];
        $this->dbUser->insertDB($params, 'numberaccount');
        session()->setFlashdata('successInsert', 'true');
        return $this->HomeUser();
    }

    public function countTheAmount(array $params, string $account): int
    {
        $price = 0;
        foreach ($params as $value) {
            $value->transferFrom === $account ?   $price -= $value->price : $price += $value->price;
        }

        return $price;
    }

    public function ajaxAccount()
    {
        $id = $this->request->getGet('id');
        $transferAccount = $this->dbUser->transferNumberAccount($id);
        $price = $this->countTheAmount($transferAccount, $id);
        echo json_encode([
            'price' => $price,
        ]);
    }

    public function ownTransfer()
    {
        $numberAccount = $this->dbUser->getAccountUser($this->id_U, 'id_U');
        if (count($numberAccount) === 1) {
            session()->setFlashdata('noOwnTransfer', 'true');
            return $this->HomeUser();
        }

        if ($this->request->getMethod() === 'post') {
            $checkVali = [
                'priceSource' => [
                    'rules' => 'validPriceAccount[priceSource]|validPriceAccountWithPrice[priceSource,price]',
                    'errors' => [
                        'validPriceAccount' => 'Brak srodków na koncie',
                        'validPriceAccountWithPrice' => 'Niewystarczająca ilość środków na koncie'
                    ]
                ],
                'price' => [
                    'rules' => 'required|validPrice[price]',
                    'errors' => [
                        'validPrice' => 'Kwota przelewu musi być wieksza od 0'
                    ]
                ]


            ];
            if (!$this->validate($checkVali)) {
                $this->data['validation'] = $this->validator;
            } else {
                $params = [
                    'transferFrom' => $this->request->getPost('accountSource'),
                    'transferTo' => $this->request->getPost('accountTarget'),
                    'title' => $this->request->getPost('description'),
                    'transferDate' => $this->request->getPost('dataTransfer'),
                    'price' => $this->request->getPost('price'),
                    'nameBank' => 'Bank Wielkopolski',
                    'adresO' => '-'
                ];
                $this->dbUser->insertDB($params, 'transfer');
                session()->setFlashdata('successTransfer', 'true');
                return $this->HomeUser();
            }
        }

        $transferAccount = $this->dbUser->transferNumberAccount($numberAccount[0]->id_N);
        $transferAccountNextAccount = $this->dbUser->transferNumberAccount($numberAccount[1]->id_N);
        $this->data['priceOneAccount'] = $this->countTheAmount($transferAccount, $numberAccount[0]->id_N);
        $this->data['priceTwoAccount'] = $this->countTheAmount($transferAccountNextAccount, $numberAccount[1]->id_N);
        $this->data['numberAccount'] = $numberAccount;


        return view('Users/ownTransfer', $this->data);
    }

    public function reportProblem()
    {
        if ($this->request->getMethod() == 'post') {
            $checkValid = [
                'titleProblem' => [
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'min_length' => 'Tytuł problemu powinien składać sie minimum z 10 znaków'
                    ]
                ],
                'descriptionProblem' => [
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'min_length' => 'Opis problemu powinien składać sie minimum z 10 znaków'
                    ]
                ],
                'dateProblems' => [
                    'rules' => 'required|validDate[dateProblems]',
                    'errors' => ['validDate' => 'Nieprawidłowa data']
                ]
            ];
            if (!$this->validate($checkValid)) {
                $this->data['validation'] = $this->validator;
            } else {
                $params = [
                    'id_U' => $this->id_U,
                    'title' => htmlentities($this->request->getPost('titleProblem')),
                    'description' => htmlentities($this->request->getPost('descriptionProblem')),
                    'dateProblems' => $this->request->getPost('dateProblems'),
                    'dateCreateProblems' => $this->request->getPost('dateCreated'),
                ];
                $this->dbUser->insertDB($params, 'messages');
                session()->setFlashdata('successSendProblem', 'true');
            }
        }

        return view('Users/reportProblem', $this->data);
    }

    public function messagesUser()
    {
        $this->data['status'] = GetStatus();
        $this->data['messages'] = $this->dbUser->getMessages(['id_U' => $this->id_U]);
        return view('Users/messagesUser', $this->data);
    }

    public function viewMessageUser(int $id)
    {

        $this->data['message'] = $this->dbUser->getMessages(['id_M' => $id]);
        return view('Users/viewMessageUser', $this->data);
    }

    public function ajaxSearch()
    {
        $dateDo = $this->request->getGet('dateDo') ?? date('Y-m-d');
        $dateOd = $this->request->getGet('dateOd') ?? date('Y-m-d');
        $params = [
            'transferDate >=' => $dateOd,
            'transferDate <=' => $dateDo
        ];

        $result = $this->dbUser->getHistoryAjax($this->id_U, $params);
        $numberAccount = $this->dbUser->getAccountUser($this->id_U, 'id_U');
        return json_encode([
            'params' => $result,
            'numberAccount' =>  $numberAccount
        ]);
    }

    public function ajaxSearchMessages()
    {


        $params = [
            'dateCreateProblems >=' => $this->request->getGet('dateOd') ?? date('Y-m-d'),
            'dateCreateProblems <=' => $this->request->getGet('dateDo') ?? date('Y-m-d'),
            'id_U' => $this->id_U,
        ];

        if ($this->request->getGet('status'))
            $params += ['status' => $this->request->getGet('status')];


        $result = $this->dbUser->getMessages($params);
        return json_encode([
            'params' => $result,

        ]);
    }

    public function GetUserIDAjax()
    {
        $id = $this->request->getGet('id');
        return json_encode([
            'user' => GetUserID($id),
        ]);
    }
}

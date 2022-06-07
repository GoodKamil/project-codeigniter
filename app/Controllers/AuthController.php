<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController extends BaseController
{
    protected $db;
    protected $data=[];

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
                'permissions' => 1,

            ];
            $result = $this->db->createUser($params);
            if ($result) {
                $params2 = [
                    'number' => CreateNumberAccount(),
                    'id_U' => $result
                ];
                $this->db->insertNumberAccount($params2);
                $this->ActiveSendEmail($result,createToken(),$params['Email']);
                return redirect()->to('/');

            }

            session()->setFlashdata('errorInsert', 'Wystąpił problem przy rejestracji');
            return view('register');
        }

        return view('register');
    }

    public function LoginUser()
    {

        if ($this->request->getMethod() === 'post') {
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
            if($user[0]->active==0)
            {
                session()->setFlashdata('error','Twoje konto jest nie akywne , prosimy aktywować konto');
                return redirect()->to('/');
            }
            $this->db->lastConnect($params);
            $sessionArray = [
                'isLoggedIn' => true,
                'permissions' => $user[0]->permissions,
                'id_U' => $user[0]->id_U
            ];
            session()->set($sessionArray);
            if ($user[0]->permissions === '1') {
                return redirect()->to('HomeUser');
            }

            if ($user[0]->permissions === '5 ') {
                return redirect()->to('messages');
            }

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

    public function recoverPassword()
    {
        if($this->request->getMethod()==='post')
        {

           $CheckValid=[
               'Email'=>[
                   'rules'=>'required|valid_email|emailExists[Email]',
                   'errors' => [
                       'valid_email' => 'Niepoprawny adres e-mail',
                       'emailExists'=>'Adres e-mail nie istnieje'
                       ]
               ]
           ];

           if(!$this->validate($CheckValid))
           {
               $this->data['validation']=$this->validator;
           }else
           {
               $email=htmlentities($this->request->getPost('Email'));
               $this->sendEmailUser($email,createToken());
           }

        }

        return view('recoverPassword',$this->data);
    }

    public function sendEmailUser(string $email,string $token)
    {
        $messages='Twój link do zmiany hasła <a href="'.base_url('recoverChangePassword/'.$email.'/'.$token).'">'.base_url('recoverChangePassword/'.$email.'/'.$token).' </a>.Prosimy nie odpowiadać na wiadomośc , w razie pytań zapraszam na stronę banku pod adresem <a href="'.base_url().'">'.base_url().'</a>';
        $subject='Odzyskiwanie konto';
        if($this->createEmailSent($messages,$subject,$email))
        {
            $this->db->updateDate(['token'=>$token],['Email'=>$email]);
            session()->setFlashdata('successSend', 'Na podany adres e-mail został wysłany link ze zmianą hasła');
        }
        else
        {
            session()->setFlashdata('errorSend', 'Wystąpił problem przy odzyskiwaniu konta');
        }


    }

    public function ActiveSendEmail(int $idUser,string $token,string $email)
    {
       $messages='Link aktywacyjny <a href="'.base_url('activeAccount/'.$idUser.'/'.$token).'">'.base_url('activeAccount/'.$idUser.'/'.$token).' </a>.Prosimy nie odpowiadać na wiadomośc , w razie pytań zapraszamy na stronę banku pod adresem <a href="'.base_url().'">'.base_url().'</a>';
        $subject='Link aktywacyjny';
        if($this->createEmailSent($messages,$subject,$email))
        {
            $this->db->updateDate(['token'=>$token],['id_U'=>$idUser]);
            session()->setFlashdata('success', 'Na podany adres e-mail został wysłany link aktywacyjny');
        }
        else
        {
            session()->setFlashdata('error', 'Wystąpił problem z wysłaniem na adres e-mail linku aktywacyjnego');
        }


    }

    public function activeAccount(string $idUser,string $token)
    {
        $user=$this->db->getUser(['id_U'=>$idUser]);
        if($user && $user[0]->token===$token && $user[0]->active==='0')
        {
            $this->db->updateDate(['token'=>NULL,'active'=>1],['id_U'=>$idUser]);
            session()->setFlashdata('success', 'Twoje konto zostało aktywowane , możesz sie zalogować');

        }
        return redirect()->to('/');
    }

    public function recoverChangePassword(string $email,string $token)
    {
            $userToken=$this->db->getUser(['Email'=>$email]);
            if($userToken[0]->token===$token) {
                $this->data['idUser']=$userToken[0]->id_U;
                return view('recoverChangePassword',$this->data);
            }
            else
                redirect()->to('/');


    }

    public function doRecoverChangePassword()
    {

        $checkValid=[
            'password'=> 'required',
            'repeatPassword'=>[
                'rules'=>'required|matches[password]',
                'errors'=> ['matches'=>'Hasła muszą być takie same']
            ]
        ];

        $idUser=$this->request->getPost('idUser');

        if(!$this->validate($checkValid))
        {
            $this->data['idUser']=$idUser;
            $this->data['validation']=$this->validator;
            return view('recoverChangePassword',$this->data);
        }

        $password=htmlentities($this->request->getPost('password'));
        $set=[
            'password'=>$this->hashPassword($password),
            'token'=>NULL
        ];
        $this->db->updateDate($set,['id_U'=>$idUser]);
        session()->setFlashdata('success','Twoje hasło zostało zmienione');
        return redirect()->to('/');
    }

    public function createEmailSent(string $messages,string $subject,string $email)
    {
        $configEmail= \Config\Services::email();
        $configEmail->setTo($email);
        $configEmail->setFrom($email);
        $configEmail->setMessage($messages);
        $configEmail->setSubject($subject);
        return $configEmail->send();
    }
}

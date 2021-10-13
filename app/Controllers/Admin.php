<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\PageModel;
use App\Models\Users\UserLoginModel;

class Admin extends BaseController
{
    protected $validation;
    protected $session;
    protected $db;
    protected $userloginModel;
    protected $functionModel;

    public function __construct()
    {

        $this->userloginModel = new UserLoginModel();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
    }

    public function index2()
    {
        $this->isLoggedIn();
    }

    /**
     * This function used to check the user is logged in or not
     */
    function index()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            return redirect()->to(site_url("/dashboard"));
        }

    }


    /**
     * This function used to logged in user
     */
    public function loginMe()
    {

//        $this->validation->setRule('email', 'Email', 'required|valid_email|trim');
//        $this->validation->setRule('password', 'Password', 'required|max_length[32]');
//
//        if ($this->validation->withRequest($this->request)->run() == FALSE) {
//            $this->index();
//        } else {

            $email = strtolower($this->request->getPost('email'));
            $password = $this->request->getPost('password');

            $result = $this->userloginModel->loginMe($email, $password);


            if (!empty($result)) {

                // Remember me (Remembering the user email and password) Start
//                if (!empty($this->Request->getPost("remember"))) {
//
//                    setcookie('login_email', $email, time() + (86400 * 30), "/");
//                    setcookie('login_password', $password, time() + (86400 * 30), "/");
//
//                } else {
//                    if (isset($_COOKIE['login_email'])) {
//                        setcookie('login_email', '', 0, "/");
//                    }
//                    if (isset($_COOKIE['login_password'])) {
//                        setcookie('login_password', '', 0, "/");
//                    }
//                }
                // Remember me (Remembering the user email and password) End



                $sessionArray = array(
                    'user_id' => $result->ID,
                    'username' => $result->username,
                    'isLoggedInAdmin' => TRUE
                );

                $this->session->set($sessionArray);


                return redirect()->to(site_url("/dashboard"));
            } else {
                $this->session->setFlashdata('error', 'Email or password mismatch');
                $this->index();
            }
//        }
    }




    function logout()
    {
        $session = \Config\Services::session();

        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['isLoggedInAdmin']);

        $session->destroy();
        return redirect()->to(site_url("/admin"));
    }





}

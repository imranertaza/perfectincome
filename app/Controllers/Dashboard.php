<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\PageModel;
use App\Models\Users\UserLoginModel;

class Dashboard extends BaseController
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

    public function index()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = ['functionModel' => $this->functionModel, ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/index',$data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    /**
     * This function used to check the user is logged in or not
     */



    /**
     * This function used to logged in user
     */








}

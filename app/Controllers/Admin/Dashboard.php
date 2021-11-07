<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/index',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * This function used to check the user is logged in or not
     */



    /**
     * This function used to logged in user
     */








}

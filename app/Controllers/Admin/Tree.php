<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\UserModel;

class Tree extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $pager;
    protected $userModel;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->pager = \Config\Services::pager();
        $this->userModel = new UserModel();
        helper('Member');
    }


    public function index($user_id = 0)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
                'user_id' => $user_id,
                'ID' => $this->session->user_id,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Tree/view_tree', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }






}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Settings\Global_settings;
use App\Models\FunctionModel;

class Theme_settings extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $globalSettings;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->globalSettings = new Global_settings();
    }

    public function index()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
                'globalSettings' => $this->globalSettings,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Global/theme_settings',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action(){
        $title['theme'] = $this->request->getPost('theme');

        foreach ($title as $key => $item) {
            $table = DB()->table('global_settings');
            $table->set('value', $item);
            $table->where('title',$key);
            $table->update();
        }

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Admin/Theme_settings"));
    }








}

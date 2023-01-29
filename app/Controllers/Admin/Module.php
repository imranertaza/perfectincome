<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\ModuleModel;

class Module extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $moduleModel;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->moduleModel = new ModuleModel();
    }

    public function index()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
                'moduleModel' => $this->moduleModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('module') == true) {
                echo view('Admin/Module/view_module',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }


    public function setting($id) {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('module_settings');
            $query = $table->where('module_id',$id)->get()->getRow();

            $data = [
                'functionModel' => $this->functionModel,
                'setting' => $query
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('module') == true) {
                echo view('Admin/Module/setting',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }

    }


    public function update_setting(){

        $id = $this->request->getPost('module_id');
        $table = DB()->table('module_settings');
        $table->where('module_id', $id);

        $fildes['title'] = $this->request->getPost('title');
        $fildes['value'] = $this->request->getPost('value');

        if ($table->update($fildes)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
            return redirect()->to(site_url("/Admin/Module/setting/".$id));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }


}

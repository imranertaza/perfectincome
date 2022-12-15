<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FunctionModel;

class Package extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;

    public function __construct()
    {

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
            $table = DB()->table('package');
            $sql = $table->get();
            $result = $sql->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'package' => $result,

            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Package/index', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function add()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Package/form', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action()
    {

        $data = array(
          'package_name' => $this->request->getPost('name'),
          'price' => $this->request->getPost('price'),
          'sponsor_commission' => $this->request->getPost('sponsor_commission'),
          'matching_commission' => $this->request->getPost('matching_commission'),
          'point' => $this->request->getPost('point'),
          'video_watch_earning' => $this->request->getPost('video_watch_earning'),
          'description' => $this->request->getPost('description'),
        );

        $table = DB()->table('package');
        $table->insert($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("/Admin/package"));
    }


    public function update($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('package');
            $sql = $table->where('package_id', $id)->get();
            $query = $sql->getRow();
            $data = [
                'functionModel' => $this->functionModel,
                'package' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Package/update', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_action(){
        $data = array(
            'package_name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'sponsor_commission' => $this->request->getPost('sponsor_commission'),
            'matching_commission' => $this->request->getPost('matching_commission'),
            'point' => $this->request->getPost('point'),
            'video_watch_earning' => $this->request->getPost('video_watch_earning'),
            'description' => $this->request->getPost('description'),
        );

        $table = DB()->table('package');
        $table->where('package_id',$this->request->getPost('package_id'))->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("/Admin/package"));
    }

    public function delete($id){
        $table = DB()->table('package');
        $table->where('package_id',$id)->delete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("/Admin/package"));
    }


}

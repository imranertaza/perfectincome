<?php

namespace App\Controllers;

use App\Models\FunctionModel;

class Menufacture extends BaseController
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
            $table = DB()->table('menufacture');
            $query = $table->get();
            $menuf = $query->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'menufacture' => $menuf,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Menufacture/list',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function add(){
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
                echo view('Admin/Menufacture/add',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action(){
        $fields['brand_name'] = $this->request->getPost('menu_name');

        $menufacture = DB()->table('menufacture');
        $menufacture->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("/Menufacture"));
    }

    public function edit($id){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('menufacture');
            $sql = $table->where('men_id',$id)->get();
            $query = $sql->getRow();
            $data = [
                'functionModel' => $this->functionModel,
                'menufacture' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Menufacture/edit', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_action(){
        $id = $this->request->getPost('id');
        $fields['brand_name'] = $this->request->getPost('menu_name');

        $product_cat = DB()->table('menufacture');
        $product_cat->where('men_id',$id);
        $product_cat->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("/Menufacture"));
    }

    public function delete($id){
        $menufacture = DB()->table('menufacture');
        $menufacture->where('men_id',$id);
        $menufacture->delete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
        return redirect()->to(site_url("/Menufacture"));
    }










}

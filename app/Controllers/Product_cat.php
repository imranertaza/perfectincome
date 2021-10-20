<?php

namespace App\Controllers;

use App\Models\FunctionModel;

class Product_cat extends BaseController
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
            $table = DB()->table('product_cat');
            $sql = $table->get();
            $query = $sql->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'proCat' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Product_cat/list',$data);
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
                echo view('Admin/Product_cat/add',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action(){
        $fields['cat_name'] = $this->request->getPost('cat_name');
        $fields['perent_id '] = $this->request->getPost('perent');

        $product_cat = DB()->table('product_cat');
        $product_cat->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("/Product_cat"));
    }

    public function edit($id){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('product_cat');
            $sql = $table->where('cat_id',$id)->get();
            $query = $sql->getRow();
            $data = [
                'functionModel' => $this->functionModel,
                'get_category' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Product_cat/edit', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_action(){
        $id = $this->request->getPost('id');
        $fields['cat_name'] = $this->request->getPost('cat_name');
        $fields['perent_id '] = $this->request->getPost('perent');

        $product_cat = DB()->table('product_cat');
        $product_cat->where('cat_id',$id);
        $product_cat->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("/Product_cat"));
    }

    public function delete($id){
        $product_cat = DB()->table('product_cat');
        $product_cat->where('cat_id',$id);
        $product_cat->delete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
        return redirect()->to(site_url("/Product_cat"));
    }










}

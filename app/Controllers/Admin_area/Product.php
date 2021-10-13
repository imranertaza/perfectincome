<?php

namespace App\Controllers\Admin_area;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Product\ProductfunctionModel;
use App\Models\ProductModel;

class Product extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $pager;
    protected $productModel;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->pager = \Config\Services::pager();
        $this->productModel = new ProductModel();
        $this->productfunctionModel = new ProductfunctionModel();
        helper('Product');

    }


    public function list(){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $key = null;
            $search = $this->request->getGet('name');

            if (!empty($search)){
                $pro = $this->productModel->like('name',$search)->paginate(10);
                $key = $search;
            }else{
                $pro = $this->productModel->paginate(10);
            }


            $data = [
                'functionModel' => $this->functionModel,
                'productfunctionModel' => $this->productfunctionModel,
                'product' => $pro,
                'pager' => $this->productModel->pager,
                'searchkey' => $key,
            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Product/list', $data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    public function view($id){

        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $product = $this->productModel->where('pro_id',$id)->first();
            $img = $this->productfunctionModel->view_product_image($id, 150, 150);
            $data = [
                'functionModel' => $this->functionModel,
                'productfunctionModel' => $this->productfunctionModel,
                'row' => $product,
                'pro_image' => $img,
            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Product/view', $data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    public function edit($id){

        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $product = $this->productModel->where('pro_id',$id)->first();
            $img = $this->productfunctionModel->view_product_image($id, 150, 150);
            $data = [
                'functionModel' => $this->functionModel,
                'productfunctionModel' => $this->productfunctionModel,
                'row' => $product,
                'pro_image' => $img,
            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Product/edit', $data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    public function update(){

        $pro_id = $this->request->getPost('pro_id');
        $fields['name'] = $this->request->getPost('name');
        $fields['model'] = $this->request->getPost('model');
        $fields['men_id'] = $this->request->getPost('men_id');
        $fields['cat_id'] = $this->request->getPost('pro_cat_id');
        $fields['filter_id'] = $this->request->getPost('filter_id');
        $fields['colors'] = $this->request->getPost('color');
        $fields['size'] = $this->request->getPost('size');
        $fields['Point'] = $this->request->getPost('Point');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['quality'] = $this->request->getPost('quality');
        $fields['discount'] = $this->request->getPost('discount');
        $fields['special'] = $this->request->getPost('special');
        $fields['price'] = $this->request->getPost('price');
        $fields['description'] = $this->request->getPost('description');


        if (!empty($_FILES['main_img']['name'])) {
            $image = $this->request->getFile('main_img');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\pro_image', $name);
            $fields['main_image'] = $name;
        }

        $product = DB()->table('products');
        $product->where('pro_id', $pro_id);
        if ($product->update($fields)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
            return redirect()->to(site_url("/Admin_area/Product/list"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }

    }

    public function add(){

        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
                'productfunctionModel' => $this->productfunctionModel,
            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Product/add', $data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    public function action(){

        $fields['name'] = $this->request->getPost('name');
        $fields['model'] = $this->request->getPost('model');
        $fields['men_id'] = $this->request->getPost('men_id');
        $fields['cat_id'] = $this->request->getPost('pro_cat_id');
        $fields['filter_id'] = $this->request->getPost('filter_id');
        $fields['colors'] = $this->request->getPost('color');
        $fields['size'] = $this->request->getPost('size');
        $fields['Point'] = $this->request->getPost('Point');
        $fields['quantity'] = $this->request->getPost('quantity');
        $fields['quality'] = $this->request->getPost('quality');
        $fields['discount'] = $this->request->getPost('discount');
        $fields['special'] = $this->request->getPost('special');
        $fields['price'] = $this->request->getPost('price');
        $fields['description'] = $this->request->getPost('description');

        if (!empty($_FILES['main_img']['name'])) {
            $image = $this->request->getFile('main_img');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\pro_image', $name);
            $fields['main_image'] = $name;
        }

        $product = DB()->table('products');
        if ($product->insert($fields)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
            return redirect()->to(site_url("/Admin_area/Product/list"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }

    public function delete($id){
        $product = DB()->table('products');

        if ($product->delete(['pro_id' => $id])) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
            return redirect()->to(site_url("/Admin_area/Product/list"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }










}

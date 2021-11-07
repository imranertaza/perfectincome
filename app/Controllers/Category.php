<?php

namespace App\Controllers;


use App\Models\Category\CategoryModel;
use App\Models\FunctionModel;

class Category extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $pager;
    protected $categoryModel;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->pager = \Config\Services::pager();
        $this->categoryModel = new CategoryModel();
        helper('Member');
    }


    public function category_list()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('category');
            $query = $table->get();
            $cat = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'category' => $cat,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {

                echo view('Admin/Category/category_list',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function view($id)
    {

        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $member = $this->userModel->where('ID', $id)->first();
            $img = view_member_image($id, 150, 150);
            $data = [
                'functionModel' => $this->functionModel,
                'row' => $member,
                'pro_image' => $img,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Member/view', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function edit_category($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('category');
            $query = $table->get();
            $cat = $query->getRow();
            $data = [
                'functionModel' => $this->functionModel,
                'get_category' => $cat,
                'categoryModel' => $this->categoryModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Category/edit_category', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update()
    {

        $cat_id = $this->request->getPost('cat_id');
        $users['cat_name'] = $this->request->getPost('cat_name');
        $users['perent_id'] = $this->request->getPost('perent');

        $category = DB()->table('category');
        $category->where('cat_id', $cat_id);
        $category->update($users);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Category/category_list"));


    }

    public function add_category()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
                'categoryModel' => $this->categoryModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Category/add_category',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action()
    {

        $fields['cat_name'] = $this->request->getPost('cat_name');
        $fields['perent_id'] = $this->request->getPost('perent');

        $category = DB()->table('category');
        $category->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("Category/category_list"));

    }

    public function delete($id)
    {
        $category = DB()->table('category');

        if ($category->delete(['cat_id' => $id])) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
            return redirect()->to(site_url("Category/category_list"));
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }


}

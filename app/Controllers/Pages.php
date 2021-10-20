<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\Pages\PageModel;
use App\Models\Users\UserLoginModel;

class Pages extends BaseController
{
    protected $validation;
    protected $session;
    protected $db;
    protected $userloginModel;
    protected $functionModel;
    protected $pageModel;

    public function __construct()
    {

        $this->userloginModel = new UserLoginModel();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->pageModel = new PageModel();
        $this->validation = \Config\Services::validation();
    }

    public function page_list()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = ['functionModel' => $this->functionModel,'pageModel' => $this->pageModel ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Pages/page_list',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function edit_page($page_id){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $page = DB()->table('pages');
            $query = $page->where('page_id',$page_id)->get();

            $data = [
                'functionModel' => $this->functionModel,
                'pageModel' => $this->pageModel,
                'page_id' => $page_id,
                'pageData' => $query->getRow(),
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Pages/edit_page', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update(){

        $id = $this->request->getPost('page_id');
        $page = DB()->table('pages');
        $page->where('page_id', $id);

        $fildes['temp'] = $this->request->getPost('page_template');
        $fildes['page_title'] = $this->request->getPost('page_tilte');
        $fildes['page_description'] = $this->request->getPost('description');
        $fildes['short_des'] = $this->request->getPost('short_description');

        if ($page->update($fildes)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
            return redirect()->to(site_url("/pages/page_list"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }

    public function add_new_page(){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
                'pageModel' => $this->pageModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('add_page') == true) {
                echo view('Admin/Pages/add_new_page',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action(){

        $fildes['temp'] = $this->request->getPost('page_template');
        $fildes['page_title'] = $this->request->getPost('page_tilte');
        $fildes['page_description'] = $this->request->getPost('description');
        $fildes['short_des'] = $this->request->getPost('short_description');
        $fildes['page_type'] = 'page';
        $page = DB()->table('pages');
        if ($page->insert($fildes)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Insert successfully</div>');
            return redirect()->to(site_url("/pages/page_list"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }

    }

    public function delete($id){
        $page = DB()->table('pages');

        if ($page->delete(['page_id' => $id])) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
            return redirect()->to(site_url("/pages/page_list"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }








}

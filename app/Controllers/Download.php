<?php

namespace App\Controllers;

use App\Models\FunctionModel;

class Download extends BaseController
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
            $table = DB()->table('downloads');
            $query = $table->get();
            $down = $query->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'downloads' => $down,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Download/download_list', $data);
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
            $table = DB()->table('downloads');
            $query = $table->get();
            $down = $query->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'downloads' => $down,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Download/add_new_download', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action(){
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['cat_id'] = $this->request->getPost('category');

        if (!empty($_FILES['userfile']['name'])) {
            $image = $this->request->getFile('userfile');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\downloads', $name);
            $fields['file'] = $name;
        }

        $downloads = DB()->table('downloads');
        $downloads->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("/Download"));
    }

    public function edit_download($id){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('downloads');
            $query = $table->where('dwn_id',$id)->get();
            $down = $query->getRow();

            $data = [
                'functionModel' => $this->functionModel,
                'row' => $down,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Download/edit_download', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_action(){
        $dwn_id = $this->request->getPost('dwn_id');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['cat_id'] = $this->request->getPost('category');

        if (!empty($_FILES['userfile']['name'])) {
            $image = $this->request->getFile('userfile');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\downloads', $name);
            $fields['file'] = $name;
        }

        $downloads = DB()->table('downloads');
        $downloads->where('dwn_id',$dwn_id);
        $downloads->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("/Download"));
    }

    public function delete($id){
        $downloads = DB()->table('downloads');
        $downloads->delete(['dwn_id' => $id]);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
        return redirect()->to(site_url("/Download"));
    }








}

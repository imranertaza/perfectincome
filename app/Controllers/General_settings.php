<?php

namespace App\Controllers;

use App\Models\Settings\Global_settings;
use App\Models\FunctionModel;

class General_settings extends BaseController
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
                echo view('Admin/Global/settings_page',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action(){
        $title['site_title'] = $this->request->getPost('site_title');
        $title['gen_email'] = $this->request->getPost('gen_email');
        $title['form_email'] = $this->request->getPost('form_email');
        $title['contact_email'] = $this->request->getPost('contact_email');

        foreach ($title as $key => $item) {
            $table = DB()->table('global_settings');
            $table->set('value', $item);
            $table->where('title',$key);
            $table->update();
        }


        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("General_settings"));
    }

    public function slider(){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('slider_gallery');
            $sql = $table->where('type','slider')->get();
            $query = $sql->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'globalSettings' => $this->globalSettings,
                'records' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Slider/list', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function create_slide(){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('slider_gallery');
            $sql = $table->where('type','slider')->get();
            $query = $sql->getResult();
            $data = [
                'functionModel' => $this->functionModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Slider/upload', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function slide_action(){
        $fields['name'] = $this->request->getPost('sl_name');
        $fields['type'] = $this->request->getPost('type');


        if (!empty($_FILES['main_img']['name'])) {
            $image = $this->request->getFile('main_img');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\gallery', $name);
            $fields['image'] = $name;
        }

        $sliderGallery = DB()->table('slider_gallery');
        if ($sliderGallery->insert($fields)) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Insert successfully</div>');
//            return redirect()->to(site_url("/General_settings/slider"));
            return redirect()->back();
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }

    public function delete($id){
        $sliderGallery = DB()->table('slider_gallery');
        $sliderGallery->where('sl_id',$id);
        if ($sliderGallery->delete()) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Deleted successfully</div>');
            return redirect()->back();
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }

    public function gallery(){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('slider_gallery');
            $sql = $table->where('type','gallery')->get();
            $query = $sql->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'records' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Gallery/list', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }
    public function upload_image_gallery(){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('slider_gallery');
            $sql = $table->where('type','gallery')->get();
            $query = $sql->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'records' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Gallery/upload', $data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }







}

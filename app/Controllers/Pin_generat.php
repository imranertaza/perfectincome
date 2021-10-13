<?php

namespace App\Controllers;

use App\Models\FunctionModel;

class Pin_generat extends BaseController
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
            $table = DB()->table('pins');
            $sql = $table->groupBy('user_id')->get();
            $result = $sql->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'pins' => $result,

            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Pine_gnerate/pin_generate',$data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
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

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Pine_gnerate/pin_generate_form',$data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    public function pin_generat_action(){

        $num_pins = $this->request->getPost('amount');
        $userName = $this->request->getPost('user_id');
        $usrID = get_userid_by_username($userName);
        for($i = 1; $i <= $num_pins; $i++) {
            $pin = $this->generate();
            $data = [
                'user_id' => $usrID,
                'pin' => $pin,
            ];
            $table = DB()->table('pins');
            $table->insert($data);
        }

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("/Pin_generat"));
    }

    public function generate()
    {
        $pins = rand(1, 1000000);
        return $pins;
    }

    public function view_agent_pin($id){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('pins');
            $sql  = $table->where('user_id',$id)->get();
            $query = $sql->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'agent' => $query,
            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Pine_gnerate/view_pin',$data);
            }else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }










}

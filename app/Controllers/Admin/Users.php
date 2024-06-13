<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\Category\CategoryModel;
use App\Models\FunctionModel;

class Users extends BaseController
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


    public function index()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('users');
            $query = $table->select('*')->join('user_roles', 'user_roles.userID = users.ID')->where('user_roles.roleID','6')->get();
            $agent = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'agent' => $agent,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Users/user_list',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function edit($id){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('users');
            $query = $table->where('ID',$id)->get()->getRow();

            $data = [
                'functionModel' => $this->functionModel,
                'agent' => $query
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Users/update',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }

    }

    public function update_action(){
        $id = $this->request->getPost('ID');

        $data['email'] = $this->request->getPost('email');
        $data['username'] = $this->request->getPost('username');
        if (!empty($this->request->getPost('password'))) {
            $data['password'] = md5($this->request->getPost('password'));
        }
        $data['f_name'] = $this->request->getPost('f_name');
        $data['l_name'] = $this->request->getPost('l_name');
        $data['phn_no'] = $this->request->getPost('phn_no');
        $data['address1'] = $this->request->getPost('address1');
        $data['address2'] = $this->request->getPost('address2');
        $data['country'] = $this->request->getPost('country');
        $data['status'] = $this->request->getPost('status');

        $table = DB()->table('users');
        $table->where('ID',$id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data Update successfully</div>');
        return redirect()->back();
    }


    public function withdraw_request()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('history_transection_admin');
            $query = $table->orderBy('history_admin_tran_id','DESC')->get();
            $agentWith = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'agentWith' => $agentWith,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Agent/withdraw_request',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }
    public function withdraw_request_list($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('history_transection_agent');
            $query = $table->where('receiver_id',$id)->orderBy('history_agent_tran_id','DESC')->get();
            $agentWith = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'agentWith' => $agentWith,
                'agentId' => $id,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Agent/withdraw_request_list',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

}

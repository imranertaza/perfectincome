<?php

namespace App\Controllers\Admin_ut;

use App\Controllers\BaseController;
use App\Models\FunctionModel;

class Balance_history extends BaseController
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
            $table = DB()->table('users');
            $sql = $table->where('type',2)->get();
            $query = $sql->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'records' => $query,
            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Request/agent_balance_list', $data);
            } else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    public function action()
    {

        $user_name = $this->request->getPost('username');
        $balance = $this->request->getPost('balance');

        $adminBalance = get_field_by_id_from_table('users', 'balance', 'ID', '1');
        $totalAdminBalance = $adminBalance - $balance;

        if ($adminBalance >= $balance) {

            //Insert
            $sendarID = $this->session->user_id;
            $receiverId = get_userid_by_username($user_name);

            $data = array(
                'sender_id' => $sendarID,
                'receiver_id' => $receiverId,
                'purpose' => 'Get Balance Frome Admin',
                'amount' => $balance,
            );
            $trans = DB()->table('history_transection');

            $trans->insert($data);

            //Update Balance
            $userBalance = get_balance_by_id($receiverId);
            $totalBalance = $userBalance + $balance;
            $upBal['balance'] = $totalBalance;
            $tblup = DB()->table('users');
            $tblup->where('ID',$receiverId);
            $tblup->update($upBal);
            //Update Admin Balance

            $admindata = array(
                'balance' => $totalAdminBalance,
            );
            $tblAdup = DB()->table('users');
            $tblAdup->where('ID', 1);
            $tblAdup->update($admindata);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
            return redirect()->to(site_url("Admin_ut/Balance_history"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> You do not have enough balance for this payment..</div>');
            return redirect()->to(site_url("Admin_ut/Balance_history"));
        }


    }

    public function edit($id)
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

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Member/edit', $data);
            } else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }

    public function update()
    {

        //$id = $this->Request->getPost('pro_id');
        $ID = $this->request->getPost('id');
        $users['f_name'] = $this->request->getPost('fname');
        $users['l_name'] = $this->request->getPost('lname');
        $users['address1'] = $this->request->getPost('addr');
        $users['address2'] = $this->request->getPost('per_addr');
        $users['phn_no'] = $this->request->getPost('phone');
        $users['nid'] = $this->request->getPost('nid');
        $users['father'] = $this->request->getPost('father');
        $users['mother'] = $this->request->getPost('mother');
        $users['religion'] = $this->request->getPost('religion');
        $users['sex'] = $this->request->getPost('sex');
        $users['blood'] = $this->request->getPost('b_group');
        $users['division'] = $this->request->getPost('division');
        $users['district'] = $this->request->getPost('district');
        $users['upozila'] = $this->request->getPost('upozila');
        $users['union'] = $this->request->getPost('union');
        $users['post'] = $this->request->getPost('post_code');
        $users['username'] = $this->request->getPost('uname');
        $users['password'] = md5($this->request->getPost('pass'));
        $users['email'] = $this->request->getPost('email');
        $users['nominee'] = $this->request->getPost('non');
        $users['relationship'] = $this->request->getPost('relation');
        $users['bank_name'] = $this->request->getPost('banks');
        $users['account_no'] = $this->request->getPost('account_no');
        $users['nom_dob'] = $this->request->getPost('nodob');

        if (!empty($_FILES['photo']['name'])) {
            $image = $this->request->getFile('photo');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\user_image', $name);
            $fields['photo'] = $name;
        }


        $user = DB()->table('users');
        $user->where('ID', $ID);
        $user->update($users);


//        $fields['spon_id'] = $this->Request->getPost('spon_id');
//        $fields['ref_id'] = $this->Request->getPost('ref_id');
//        $fields['pr_id'] = $this->Request->getPost('p_id');
//        $fields['position'] = $this->Request->getPost('position');
//
//        $Tree = DB()->table('Tree');
//        $Tree->where('u_id', $ID);
//        $Tree->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Admin_area/member/list"));


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

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                //echo view('Admin/Product/add', $data);
                echo view('Admin/Member/add', $data);
            } else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
        }
    }






}

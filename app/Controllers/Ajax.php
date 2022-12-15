<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\UserModel;

class Ajax extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $pager;
    protected $userModel;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->pager = \Config\Services::pager();
        $this->userModel = new UserModel();
        helper('Member');
    }

    public function check_username(){
        $username = $this->request->getPost('username');
        $table = DB()->table('users');
        $query = $table->where('username',$username)->countAllResults();
        if(!empty($query)){
            return '1';
        }else {
            return '0';
        }
    }

    public function check_valid_agent(){
        $username = $this->request->getPost('username');
        $table = DB()->table('users');
        $query = $table->where('username',$username)->where('status','Active')->countAllResults();
        if(!empty($query)){
            $tableus = DB()->table('users');
            $user = $tableus->where('username',$username)->get()->getRow();

            $userRole = DB()->table('user_roles');
            $role = $userRole->where('userID',$user->ID)->get()->getRow();

            if ($role->roleID == '4'){
                return '0';
            }else{
                return '1';
            }
        }else {
            return '1';
        }
    }

    public function agent_change_with_status(){
        $status = $this->request->getPost('status');
        $id = $this->request->getPost('id');
        $amount = get_field_by_id_from_table('history_transection_agent', 'amount', 'history_agent_tran_id', $id);
        if ($status == 'confirm'){
            $agent_id = get_field_by_id_from_table('history_transection_agent', 'receiver_id', 'history_agent_tran_id', $id);
            $agentoldBal = get_field_by_id_from_table('users', 'balance', 'ID', $agent_id);
            $newAgBal = $agentoldBal+$amount;
            $upAgBal = [
                'balance' => $newAgBal,
            ];
            $agent = DB()->table('users');
            $agent->where('ID', $agent_id)->update($upAgBal);
        }

        if ($status == 'cancel'){
            $user_id = get_field_by_id_from_table('history_transection_agent', 'sender_id', 'history_agent_tran_id', $id);
            $useroldBal = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $newUsBal = $useroldBal+$amount;
            $upUsBal = [
                'balance' => $newUsBal,
            ];
            $user = DB()->table('users');
            $user->where('ID', $user_id)->update($upUsBal);
        }


        $data = [
            'status' => $status,
        ];
        $table = DB()->table('history_transection_agent');
        $table->where('history_agent_tran_id',$id)->update($data);

        return '<div class="alert alert-success alert-dismissable text-center "> Update successfully</div>';
    }



    public function admin_change_with_status(){
        $status = $this->request->getPost('status');
        $id = $this->request->getPost('id');
        $amount = get_field_by_id_from_table('history_transection_admin', 'amount', 'history_admin_tran_id', $id);
        if ($status == 'confirm'){
            $adminldBal = get_field_by_id_from_table('users', 'balance', 'ID', ADMIN_ID);
            $newAdBal = $adminldBal+$amount;
            $upAgBal = [
                'balance' => $newAdBal,
            ];
            $agent = DB()->table('users');
            $agent->where('ID', ADMIN_ID)->update($upAgBal);
        }

        if ($status == 'cancel'){
            $user_id = get_field_by_id_from_table('history_transection_admin', 'sender_id', 'history_admin_tran_id', $id);
            $useroldBal = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $newUsBal = $useroldBal+$amount;
            $upUsBal = [
                'balance' => $newUsBal,
            ];
            $user = DB()->table('users');
            $user->where('ID', $user_id)->update($upUsBal);
        }


        $data = [
            'status' => $status,
        ];
        $table = DB()->table('history_transection_admin');
        $table->where('history_admin_tran_id',$id)->update($data);

        return '<div class="alert alert-success alert-dismissable text-center "> Update successfully</div>';
    }


    public function check_hand(){
        $username = $this->request->getPost('username');
        $table = DB()->table('users');
        $query = $table->where('username',$username)->get();
        $rowuser = $query->getRow();

        $tree = DB()->table('tree');
        $sql = $tree->where('u_id',$rowuser->ID)->get();
        $row = $sql->getRow();

        $disable_l = empty($row->l_t) ? '' : 'disabled="disabled"';
        $disable_r = empty($row->r_t) ? '' : 'disabled="disabled"';
        $view ='<option selected="selected" value="0">Choose Hand</option>
			    <option value="1" '.$disable_l.'>Left</option>
           	    <option value="2" '.$disable_r.'>Right</option>';
        return $view;
    }

    public function check_agent(){
        $uname = $this->request->getPost('username');

        $table = DB()->table('users');
        $rowcount = $table->where('username',$uname)->countAllResults();
        if ($rowcount==0){
            return '0';
        }else {
            $sql = $table->where('username',$uname)->get();
            $row = $sql->getRow();
            $usrID =  $row->ID;
            $roll = DB()->table('user_roles');
            $qu = $roll->where('userID',$usrID)->get();
            $agetnId = $qu->getRow();

            $roleID = $agetnId->roleID;
            if ($roleID != 4){
                return '0';
            }else {
                return '1';
            }
        }
    }

    public function check_user(){
        $uname = $this->request->getPost('username');

        $table = DB()->table('users');
        $rowcount = $table->where('username',$uname)->countAllResults();
        if ($rowcount==0){
            return '0';
        }else {
                return '1';
        }
    }

    public function check_pin(){
        $pin = $this->request->getPost('pin');

        $tab = DB()->table('pins');
        $numRow = $tab->where('pin',$pin)->countAllResults();

        $tabile = DB()->table('pins');
        $row = $tab->where('pin',$pin)->get()->getRow();

        if ($numRow == 1) {

            $status = $row->status;
            if ($status != 'unused') {
                return '0';
            }else{
                return '1';
            }
        }else {
            return '0';
        }
    }











}

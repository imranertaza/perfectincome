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

    public function district(){
        $divisionId = $this->request->getPost('division_id');

        $table = DB()->table('Location');
        $query = $table->where('per_id',$divisionId)->get();

        $output = '<option value="0">Select District...</option>';
        foreach($query->getResult() as $row) {
            $output .= '<option value="'.$row->lo_id.'">'.$row->name.'</option>';
        }

        return $output;
    }

    public function thana(){
        $districtId = $this->request->getPost('district_id');

        $table = DB()->table('Location');
        $query = $table->where('per_id',$districtId)->get();

        $output = '<option value="0">Select Thana/upazilla...</option>';
        foreach($query->getResult() as $row) {
            $output .= '<option value="'.$row->lo_id.'">'.$row->name.'</option>';
        }

        return $output;
    }

    public function ward(){
        $thanaId = $this->request->getPost('thana_id');

        $table = DB()->table('Location');
        $query = $table->where('per_id',$thanaId)->get();

        $output = '<option value="0">Select Union/ward...</option>';
        foreach($query->getResult() as $row) {
            $output .= '<option value="'.$row->lo_id.'">'.$row->name.'</option>';
        }
        return $output;
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

    public function check_hand(){
        $username = $this->request->getPost('username');
        $table = DB()->table('users');
        $query = $table->where('username',$username)->get();
        $rowuser = $query->getRow();

        $tree = DB()->table('Tree');
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

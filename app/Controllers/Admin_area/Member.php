<?php

namespace App\Controllers\Admin_area;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\UserModel;

class Member extends BaseController
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


    public function list()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $key = null;
            $key2 = null;
            $ser_username = $this->request->getGet('ser_username');
            $ser_phone = $this->request->getGet('ser_phone');

            if (!empty($ser_username) || !empty($ser_phone)) {
                $pro = $this->userModel->like('username ', $ser_username)->like('phn_no ', $ser_phone)->paginate(10);
                $key = $ser_username;
                $key2 = $ser_phone;
            } else {
                $pro = $this->userModel->paginate(10);
            }


            $data = [
                'functionModel' => $this->functionModel,
                'member' => $pro,
                'pager' => $this->userModel->pager,
                'searchkey' => $key,
                'searchkey2' => $key2,
            ];

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Member/list', $data);
            } else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
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

            echo view('admin/header');
            echo view('admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Member/view', $data);
            } else {
                echo view('admin/no_permission');
            }
            echo view('admin/footer');
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

    public function action()
    {

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
            $users['photo'] = $name;
        }


        $user = DB()->table('users');
        $user->insert($users);
        $insert_userid = DB()->insertID();

        // Insert into user_roles
        $current_time = date('Y-M-D h:m:s');
        $data_role = array(
            'userID' => $insert_userid,
            'roleID' => 6,
            'addDate' => $current_time
        );
        $rol = DB()->table('user_roles');
        $rol->insert($data_role);

        $spon_id = $this->request->getPost('spon_id');
        $ref_id = $this->request->getPost('ref_id');
        $pr_id = $this->request->getPost('p_id');
        $position = $this->request->getPost('position');

        // Insert into Tree
        $pid = get_ID_by_username($pr_id);
        $ref_id = get_ID_by_username($ref_id);
        $spon_id = get_ID_by_username($spon_id);
        $data_tree = array(
            'u_id' => $insert_userid,
            'pr_id' => $pid,
            'ref_id' => $ref_id,
            'spon_id' => $spon_id
        );
        $tree = DB()->table('Tree');
        $tree->insert($data_tree);

        // Update Tree for left and right
        if ($position == 1) {
            $data_left_right = array(
                'l_t' => $insert_userid
            );
        }
        if ($position == 2) {
            $data_left_right = array(
                'r_t' => $insert_userid
            );
        }
        $treeup = DB()->table('Tree');
        $treeup->where('u_id', $insert_userid);
        $treeup->update($data_left_right);


        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("/Admin_area/Member/list"));

    }




}

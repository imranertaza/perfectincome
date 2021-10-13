<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Profile extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $globalSettingsModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->globalSettingsModel = new Global_settings();
    }

    public function index()
    {
        $clientLogin = $this->session->isLoggedInClient;
        if (!isset($clientLogin) || $clientLogin != TRUE) {
            return redirect()->to(site_url("Member_form/login"));
        } else {

            $user_id = $this->session->user_id;
            $data['globalSettingsModel'] = $this->globalSettingsModel;

            $data['dwn_path'] = base_url() . "/uploads/downloads/";

            $downloads = DB()->table('downloads');
            $sdow = $downloads->where('cat_id', '5')->get();
            $notice_list = $sdow->getResult();

            $downl = DB()->table('downloads');
            $notiCount = $downl->where('cat_id', '5')->countAllResults();
            if ($notiCount > 0) {
                $data['list_notice'] = $notice_list;
            } else {
                $data['list_notice'] = 'No notice published';
            }

            $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
            $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

            $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
            $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

            $data['page_title'] = 'home';
            $data['slider'] = '';


            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $data['gameBalance'] = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $user_id);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id);
            $data['user_id'] = $user_id;
            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            echo view('Front/Client_area/header', $data);


            $users = DB()->table('users');
            $sqlUs = $users->where('ID', $user_id)->get();
            $query = $sqlUs->getRow();
            $data['row'] = $query;

            echo view('Front/Client_area/Agent/profile', $data);
            echo view('Front/Client_area/footer', $data);


        }
    }

    public function profile_update()
    {
        $clientLogin = $this->session->isLoggedInClient;
        if (!isset($clientLogin) || $clientLogin != TRUE) {
            return redirect()->to(site_url("Member_form/login"));
        } else {

            $user_id = $this->session->user_id;
            $data['globalSettingsModel'] = $this->globalSettingsModel;

            $data['dwn_path'] = base_url() . "/uploads/downloads/";
            $downloads = DB()->table('downloads');
            $sdow = $downloads->where('cat_id', '5')->get();
            $notice_list = $sdow->getResult();

            $downl = DB()->table('downloads');
            $notiCount = $downl->where('cat_id', '5')->countAllResults();
            if ($notiCount > 0) {
                $data['list_notice'] = $notice_list;
            } else {
                $data['list_notice'] = 'No notice published';
            }

            $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
            $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

            $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
            $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

            $data['page_title'] = 'home';
            $data['slider'] = '';


            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $user_id;
            $data['ID'] = $user_id;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $data['gameBalance'] = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $user_id);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id);
            //$data['user_id'] = $user_id;
            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            echo view('Front/Client_area/header', $data);


            $users = DB()->table('users');
            $sqlUs = $users->where('ID', $user_id)->get();
            $query = $sqlUs->getRow();
            $data['row'] = $query;
            $data['user'] = $sqlUs->getResult();

            echo view('Front/Client_area/Agent/update', $data);
            echo view('Front/Client_area/footer', $data);

        }
    }

    public function general_action()
    {

        $id = $this->request->getPost('id');

        $data['f_name'] = $this->request->getPost('fname');
        $data['l_name'] = $this->request->getPost('lname');
        $data['address1'] = $this->request->getPost('addr');
        $data['address2'] = $this->request->getPost('per_addr');
        $data['phn_no'] = $this->request->getPost('phone');
        $data['nid'] = $this->request->getPost('nid');
        $data['father'] = $this->request->getPost('father');
        $data['mother'] = $this->request->getPost('mother');

        $tab = DB()->table('users');
        $tab->where('ID', $id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Agent/profile/profile_update"));


    }

    public function personal_action()
    {
        $id = $this->session->user_id;
        $data['blood'] = $this->request->getPost('b_group');
        $data['division'] = $this->request->getPost('division');
        $data['district'] = $this->request->getPost('district');
        $data['nominee'] = $this->request->getPost('non');
        $data['relationship'] = $this->request->getPost('relation');
        $data['nominee'] = $this->request->getPost('nodob');
        $data['sex'] = $this->request->getPost('sex');
        $data['bank_name'] = $this->request->getPost('banks');
        $data['account_no'] = $this->request->getPost('account_no');
        $data['upozila'] = $this->request->getPost('upozila');
        $data['union'] = $this->request->getPost('union');
        $data['post'] = $this->request->getPost('post_code');
        $data['religion'] = $this->request->getPost('religion');

        $tab = DB()->table('users');
        $tab->where('ID', $id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Agent/profile/profile_update"));

    }

    public function account_action()
    {
        $id = $this->session->user_id;
        $data['username'] = $this->request->getPost('uname');
        $data['email'] = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        if (!empty($pass)) {
            $data['password'] = md5($pass);
        }

        $tab = DB()->table('users');
        $tab->where('ID', $id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Agent/profile/profile_update"));
    }

    public function photo_action(){
        $id = $this->session->user_id;
        if (!empty($_FILES['photo']['name'])) {
            $image = $this->request->getFile('photo');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\user_image', $name);
            $data['photo'] = $name;

            $tab = DB()->table('users');
            $tab->where('ID', $id)->update($data);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
            return redirect()->to(site_url("Agent/profile/profile_update"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Somthing went wrong!</div>');
            return redirect()->to(site_url("Agent/profile/profile_update"));
        }

    }


}

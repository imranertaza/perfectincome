<?php

namespace App\Controllers\Member;

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

            $user_id = $this->session->user_id_client;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id);
            $data['user_id'] = $user_id;
            $data['sidebar_left'] = view('Theme/'.selected_theme().'/Front/Client_area/sidebar-left', $data);
            echo view('Theme/'.selected_theme().'/Front/Client_area/header', $data);

            $user = DB()->table('users');
            $query = $user->where('ID',$user_id)->get();
            $data['row'] = $query->getRow();

            echo view('Theme/'.selected_theme().'/Front/Client_area/Member/profile', $data);
            echo view('Theme/'.selected_theme().'/Front/Client_area/footer', $data);


        }
    }

    public function profile_update(){
        $clientLogin = $this->session->isLoggedInClient;
        if (!isset($clientLogin) || $clientLogin != TRUE) {
            return redirect()->to(site_url("Member_form/login"));
        } else {
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

            $user_id = $this->session->user_id_client;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id);
            $data['user_id'] = $user_id;
            $data['sidebar_left'] = view('Theme/'.selected_theme().'/Front/Client_area/sidebar-left', $data);
            echo view('Theme/'.selected_theme().'/Front/Client_area/header', $data);

            $user = DB()->table('users');
            $query = $user->where('ID',$user_id)->get();
            $data['row'] = $query->getRow();
            $data['user'] = $query->getResult();

            echo view('Theme/'.selected_theme().'/Front/Client_area/Member/update', $data);
            echo view('Theme/'.selected_theme().'/Front/Client_area/footer', $data);


        }
    }

    public function general_action(){
        $id = $this->session->user_id_client;
        $data['f_name'] = $this->request->getPost('fname');
        $data['l_name'] = $this->request->getPost('lname');
        $data['address1'] = $this->request->getPost('addr');
        $data['address2'] = $this->request->getPost('per_addr');
        $data['phn_no'] = $this->request->getPost('phone');
        $data['country'] = $this->request->getPost('country');

        $tab = DB()->table('users');
        $tab->where('ID', $id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Member/profile/profile_update"));
    }



    public function account_action(){

        $id = $this->session->user_id_client;
//        $data['username'] = $this->request->getPost('uname');
//        $data['email'] = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        if (!empty($pass)) {
            $data['password'] = md5($pass);
        }

        $tab = DB()->table('users');
        $tab->where('ID', $id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Member/profile/profile_update"));
    }

    public function photo_action(){
        $id = $this->session->user_id_client;
        if (!empty($_FILES['photo']['name'])) {
            $image = $this->request->getFile('photo');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\user_image', $name);
            $data['photo'] = $name;

            $tab = DB()->table('users');
            $tab->where('ID', $id)->update($data);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
            return redirect()->to(site_url("Member/profile/profile_update"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Somthing went wrong!</div>');
            return redirect()->to(site_url("Member/profile/profile_update"));
        }

    }







}

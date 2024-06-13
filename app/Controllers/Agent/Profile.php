<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;
use App\Models\Users\UserLoginModel;

class Profile extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $globalSettingsModel;
    protected $userLoginModel;

    public function __construct()
    {
        $this->functionModel = new FunctionModel();
        $this->globalSettingsModel = new Global_settings();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->userLoginModel = new UserLoginModel();
    }





    public function index(){


        $data['globalSettingsModel'] = $this->globalSettingsModel;
        $page = DB()->table('pages');
        $sPage = $page->where('page_id', '100')->get();
        $h_page_query = $sPage->getRow();
        $data['title'] = $h_page_query->page_title;
        $data['description'] = $h_page_query->page_description;
        $data['check_user'] = '';
        $data['slider'] = '';
        $login = '';

        $downloads = DB()->table('downloads');
        $notiCount = $downloads->where('cat_id', '5')->countAllResults();
        $notice_list = $downloads->where('cat_id', '5')->get();

        if ($notiCount > 0) {
            $data['list_notice'] = $notice_list->getResult();
        } else {
            $data['list_notice'] = 'No notice published';
        }
        $last_notice = $notice_list->getRow();
        $data['notice_title'] = $last_notice->title;
        $data['notice_description'] = $last_notice->description;
        $data['notice_file'] = $last_notice->file;


        $data['dwn_path'] = base_url() . "/uploads/downloads/";


        if ($notiCount > 0) {
            $data['list_notice'] = $notice_list->getResult();
        } else {
            $data['list_notice'] = 'No notice published';
        }

        $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

        $agentLogin = $this->session->isLoggedInAgent;
        if (isset($agentLogin) || $agentLogin == TRUE) {
            $data['log_url'] = 'Agent/Login/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $agentLogin;
            $user_id = $this->session->agent_id;
            $data['ID'] = $user_id;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id);
            $data['user_id'] = $user_id;

            $user = DB()->table('users');
            $query = $user->where('ID',$user_id)->get();
            $data['row'] = $query->getRow();


            $data['sidebar_left'] = view('Theme/'.selected_theme().'/Front/Client_area/agent_sidebar_left', $data);
            echo view('Theme/'.selected_theme().'/Front/Client_area/header', $data);
            echo view('Theme/'.selected_theme().'/Front/Client_area/Agent/profile', $data);
            echo view('Theme/'.selected_theme().'/Front/Client_area/footer', $data);
        } else {
            return redirect()->to(site_url("Agent/Login"));
        }


    }

    public function profile_update(){
        $data['globalSettingsModel'] = $this->globalSettingsModel;
        $page = DB()->table('pages');
        $sPage = $page->where('page_id', '100')->get();
        $h_page_query = $sPage->getRow();
        $data['title'] = $h_page_query->page_title;
        $data['description'] = $h_page_query->page_description;
        $data['check_user'] = '';
        $data['slider'] = '';
        $login = '';

        $downloads = DB()->table('downloads');
        $notiCount = $downloads->where('cat_id', '5')->countAllResults();
        $notice_list = $downloads->where('cat_id', '5')->get();

        if ($notiCount > 0) {
            $data['list_notice'] = $notice_list->getResult();
        } else {
            $data['list_notice'] = 'No notice published';
        }
        $last_notice = $notice_list->getRow();
        $data['notice_title'] = $last_notice->title;
        $data['notice_description'] = $last_notice->description;
        $data['notice_file'] = $last_notice->file;


        $data['dwn_path'] = base_url() . "/uploads/downloads/";


        if ($notiCount > 0) {
            $data['list_notice'] = $notice_list->getResult();
        } else {
            $data['list_notice'] = 'No notice published';
        }

        $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

        $agentLogin = $this->session->isLoggedInAgent;
        if (isset($agentLogin) || $agentLogin == TRUE) {
            $data['log_url'] = 'Agent/Login/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $agentLogin;
            $user_id = $this->session->agent_id;
            $data['ID'] = $user_id;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id);
            $data['user_id'] = $user_id;

            $user = DB()->table('users');
            $query = $user->where('ID',$user_id)->get();
            $data['row'] = $query->getRow();
            $data['user'] = $query->getResult();


            $data['sidebar_left'] = view('Front/Client_area/agent_sidebar_left', $data);
            echo view('Front/Client_area/header', $data);
            echo view('Front/Client_area/Agent/profile_update', $data);
            echo view('Front/Client_area/footer', $data);
        } else {
            return redirect()->to(site_url("Agent/Login"));
        }
    }

    public function general_action(){
        $id = $this->session->agent_id;
        $data['f_name'] = $this->request->getPost('fname');
        $data['l_name'] = $this->request->getPost('lname');
        $data['address1'] = $this->request->getPost('addr');
        $data['address2'] = $this->request->getPost('per_addr');
        $data['phn_no'] = $this->request->getPost('phone');
        $data['country'] = $this->request->getPost('country');

        $tab = DB()->table('users');
        $tab->where('ID', $id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Agent/Profile/profile_update"));
    }

    public function account_action(){
        $id = $this->session->agent_id;
        $data['username'] = $this->request->getPost('uname');
        $data['email'] = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        if (!empty($pass)) {
            $data['password'] = md5($pass);
        }

        $tab = DB()->table('users');
        $tab->where('ID', $id)->update($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Agent/Profile/profile_update"));
    }

    public function photo_action(){
        $id = $this->session->agent_id;
        if (!empty($_FILES['photo']['name'])) {
            $image = $this->request->getFile('photo');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\user_image', $name);
            $data['photo'] = $name;

            $tab = DB()->table('users');
            $tab->where('ID', $id)->update($data);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
            return redirect()->to(site_url("Agent/Profile/profile_update"));
        }else{
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Somthing went wrong!</div>');
            return redirect()->to(site_url("Agent/Profile/profile_update"));
        }
    }


}

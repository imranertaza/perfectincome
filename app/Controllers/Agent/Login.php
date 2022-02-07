<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;
use App\Models\Users\UserLoginModel;

class Login extends BaseController
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
            return redirect()->to(site_url("Agent/Dashboard"));
        } else {
            $data['log_url'] = 'member_form/login';
            $data['log_title'] = 'Login';
            echo view('Front/header', $data);
            echo view('Front/Client_area/Agent/login', $data);
            echo view('Front/footer', $data);
        }


    }

    public function login_action()
    {


        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $result = $this->userLoginModel->agentLogin($username, $password);

        if ($result == TRUE) {
            return redirect()->to(site_url("Agent/Dashboard"));
        }else{
            $this->session->setFlashdata('error', 'Email or password mismatch');
            $this->index();
        }

    }

    public function logout()
    {
        $session = \Config\Services::session();

        unset($_SESSION['agent_id']);
        unset($_SESSION['agentName']);
        unset($_SESSION['role_agent']);
        unset($_SESSION['isLoggedInAgent']);

        return redirect()->to(site_url("/Agent/Login"));
    }


}

<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;
use App\Models\Users\UserLoginModel;

class Member_form extends BaseController
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


    public function register()
    {
        $clientLogin = $this->session->isLoggedInClient;
        if (isset($clientLogin) || $clientLogin == TRUE) {
            return redirect()->to(site_url("agent/dashboard"));
        } else {
            $data['globalSettingsModel'] = $this->globalSettingsModel;
            $data['dwn_path'] = base_url() . "/uploads/downloads/"; //$get_download;

            $downloads = DB()->table('downloads');
            $notiCount = $downloads->where('cat_id', '5')->countAllResults();
            $notice_list = $downloads->where('cat_id', '5')->get();

            if ($notiCount > 0) {
                $data['list_notice'] = $notice_list->getResult();
            } else {
                $data['list_notice'] = 'No notice published';
            }

            $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
            $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

            $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
            $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

            $data['page_title'] = 'home';
            $data['slider'] = '';


            $data['check_user'] = '';
            $data['log_url'] = 'member_form/login';
            $data['log_title'] = 'Login';
            $data['sidebar_left'] = view('Front/sidebar-left', $data);
            echo view('Front/header', $data);
            echo view('Front/register', $data);
            echo view('Front/footer', $data);
        }


    }

    public function register_action()
    {

        $position = $this->request->getPost('position');
        if (($position == 1) || ($position == 2)) {
            DB()->transStart();
            // Insert into user
            $data_personal = array(
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('uname'),
                'password' => md5($this->request->getPost('pass')),
                'f_name' => $this->request->getPost('fname'),
                'balance' => '0',
                'Point' => '0',
                'status' => 'Inactive'
            );

            $users = DB()->table('users');
            $users->insert($data_personal);
            $userID = DB()->insertID();


            // Insert into user_role
            $current_time = date('Y-m-d h:m:s');
            $data_role = array(
                'userID' => $userID,
                'roleID' => 6,
                'addDate' => $current_time
            );
            $user_roles = DB()->table('user_roles');
            $user_roles->insert($data_role);


            // Insert into Tree
            $pid = get_ID_by_username($this->request->getPost('p_id'));
            $spon_id = get_ID_by_username($this->request->getPost('spon_id'));
            $data_tree = array(
                'u_id' => $userID,
                'pr_id' => $pid,
//                'agent_id' => $pid,
                'spon_id' => $spon_id
            );
            $tree = DB()->table('tree');
            $tree->insert($data_tree);

            // Update Tree for left and right
            if ($position == 1) {
                $data_left_right = array(
                    'l_t' => $userID
                );
            }
            if ($position == 2) {
                $data_left_right = array(
                    'r_t' => $userID
                );
            }
            $treeUp = DB()->table('tree');
            $treeUp->where('u_id', $pid)->update($data_left_right);

            DB()->transComplete();

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "> Successfully Registered. Please Login</div>');
            return redirect()->to(site_url("/member_form/login"));

        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "> Email or password mismatch</div>');
            return redirect()->to(site_url("/member_form/register"));
        }
    }


    public function login()
    {

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

        $clientLogin = $this->session->isLoggedInClient;
        if (isset($clientLogin) || $clientLogin == TRUE) {
            return redirect()->to(site_url("Member/dashboard"));
        } else {
            $data['log_url'] = 'member_form/login';
            $data['log_title'] = 'Login';
            $data['sidebar_left'] = view('Front/sidebar-left', $data);
            echo view('Front/header', $data);
            echo view('Front/member_form', $data);
            echo view('Front/footer', $data);
        }

    }

    public function login_action()
    {


        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $result = $this->userLoginModel->memberLogin($username, $password);

        if ($result == TRUE) {
            return redirect()->to(site_url("Member/dashboard"));
        }else{
            $this->session->setFlashdata('error', 'Email or password mismatch');
            $this->login();
        }

    }

    public function logout()
    {
        $session = \Config\Services::session();

        unset($_SESSION['user_id_client']);
        unset($_SESSION['username_client']);
        unset($_SESSION['role_client']);
        unset($_SESSION['isLoggedInClient']);
        
        return redirect()->to(site_url("/member_form/login"));
    }


}

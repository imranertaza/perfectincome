<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class General extends BaseController
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

            $role = $this->session->role;
            $user_id = $this->session->user_id;
            if ($role == 6) {
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
                $data['sidebar_left'] = view('Front/client_area/sidebar-left', $data);
                echo view('Front/Client_area/header', $data);

                $user = DB()->table('users');
                $sqlUs = $user->where('ID', $user_id)->get();
                $data['row'] = $sqlUs->getRow();

                $tree = DB()->table('tree');
                $sqlTre = $tree->where('ref_id', $user_id)->get();
                $data['query'] = $sqlTre->getResult();

                echo view('Front/Client_area/Member/dashboard', $data);
                echo view('Front/Client_area/footer', $data);
            }


        }
    }


    public function tree($user_id = 0)
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

            $user_id2 = $this->session->user_id;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id2;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id2);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id2);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id2);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id2);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id2);
            $data['lpoint'] = get_field_by_id_from_table('users', 'lpoint', 'ID', $user_id2);
            $data['rpoint'] = get_field_by_id_from_table('users', 'rpoint', 'ID', $user_id2);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id2);



            $data['p_id'] = empty($user_id) ? get_field_by_id_from_table('Tree', 'pr_id', 'u_id', $user_id2) : get_field_by_id_from_table('Tree', 'pr_id', 'u_id', $user_id);
            if (($user_id == $user_id2) || (empty($user_id))) {
                $data['p_id'] = "";
            }

            $memUser = $this->request->getPost('member_user');
            if (isset($memUser)) {
                $user_id = get_ID_by_username($memUser);
            }
            $data['user_id'] = $user_id;

            $comMetc = DB()->table('comm_matching');
            $data['com_taken_matching'] = $comMetc->where('u_id',$user_id2)->countAllResults();

            $data['min_matching_com'] = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);

            echo view('Front/Client_area/header', $data);
            echo view('Front/Client_area/member/tree', $data);
            echo view('Front/Client_area/footer', $data);

        }

    }

    public function referrals($user_id = 0)
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

            $user_id2 = $this->session->user_id;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id2;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id2);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id2);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id2);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id2);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id2);
            $data['lpoint'] = get_field_by_id_from_table('users', 'lpoint', 'ID', $user_id2);
            $data['rpoint'] = get_field_by_id_from_table('users', 'rpoint', 'ID', $user_id2);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id2);
            $data['user_id'] = $user_id;

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            echo view('Front/Client_area/header', $data);

            $tree = DB()->table('tree');
            $data['query'] = $tree->where('spon_id',$user_id2)->get()->getResult();

            echo view('Front/Client_area/Member/referrals', $data);
            echo view('Front/Client_area/footer', $data);
        }
    }

    public function withdraw($user_id = 0)
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

            $user_id2 = $this->session->user_id;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id2;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id2);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id2);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id2);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id2);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id2);
            $data['lpoint'] = get_field_by_id_from_table('users', 'lpoint', 'ID', $user_id2);
            $data['rpoint'] = get_field_by_id_from_table('users', 'rpoint', 'ID', $user_id2);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id2);
            $data['user_id'] = $user_id;

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            echo view('Front/Client_area/header', $data);


            //query nagad transection list for this user
            $withwNaga = DB()->table('history_withdraw_nagad');
            $data['nagad_trans'] = $withwNaga->where('receiver_id',$user_id2)->get()->getResult();

            //query nagad transection list for this user
            $withwpm = DB()->table('history_withdraw_pm');
            $data['PM_trans'] = $withwpm->where('receiver_id',$user_id2)->get()->getResult();

            $tree = DB()->table('tree');
            $data['query'] = $tree->where('ref_id',$user_id2)->get()->getResult();

            echo view('Front/Client_area/Member/withdraw_money', $data);
            echo view('Front/Client_area/footer', $data);
        }
    }

    public function withdraw_report($user_id = 0)
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

            $user_id2 = $this->session->user_id;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id2;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id2);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id2);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id2);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id2);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id2);
            $data['lpoint'] = get_field_by_id_from_table('users', 'lpoint', 'ID', $user_id2);
            $data['rpoint'] = get_field_by_id_from_table('users', 'rpoint', 'ID', $user_id2);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id2);
            $data['user_id'] = $user_id;

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            echo view('Front/Client_area/header', $data);

            $withw = DB()->table('withdrow_req_match');
            $data['with_match'] = $withw->where('form',$user_id2)->get()->getResult();

            echo view('Front/Client_area/Member/withdraw_report', $data);
            echo view('Front/Client_area/footer', $data);
        }
    }


    public function matching_report($user_id = 0)
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

            $user_id2 = $this->session->user_id;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $user_id2;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id2);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id2);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id2);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id2);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id2);
            $data['lpoint'] = get_field_by_id_from_table('users', 'lpoint', 'ID', $user_id2);
            $data['rpoint'] = get_field_by_id_from_table('users', 'rpoint', 'ID', $user_id2);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id2);
            $data['user_id'] = $user_id;

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            echo view('Front/Client_area/header', $data);

            $comm_matching = DB()->table('comm_matching');
            $comm_matching->where('u_id',$user_id2)->get()->getResult();
            $data['querya'] = $comm_matching->where('u_id',$user_id2)->get()->getResult();

            $comNum = DB()->table('comm_matching');
            $data['com_taken_matching'] = $comNum->where('u_id',$user_id2)->countAllResults();

            $commsum = DB()->table('comm_matching');
            $data['total_matching_amount'] = $commsum->selectSum('amount')->where('u_id',$user_id2)->get();


            echo view('Front/Client_area/Member/matching_report', $data);
            echo view('Front/Client_area/footer', $data);
        }
    }







}

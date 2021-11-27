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

            $role = $this->session->role_client;
            $user_id = $this->session->user_id_client;
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
                $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
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

            $user_id2 = $this->session->user_id_client;
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


            $data['p_id'] = empty($user_id) ? get_field_by_id_from_table('tree', 'pr_id', 'u_id', $user_id2) : get_field_by_id_from_table('tree', 'pr_id', 'u_id', $user_id);
            if (($user_id == $user_id2) || (empty($user_id))) {
                $data['p_id'] = "";
            }

            $memUser = $this->request->getPost('member_user');
            if (isset($memUser)) {
                $user_id = get_ID_by_username($memUser);
            }
            $data['user_id'] = $user_id;

            $comMetc = DB()->table('comm_matching');
            $data['com_taken_matching'] = $comMetc->where('u_id', $user_id2)->countAllResults();

            $data['min_matching_com'] = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);

            echo view('Front/Client_area/header', $data);
            echo view('Front/Client_area/Member/tree', $data);
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

            $user_id2 = $this->session->user_id_client;
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
            $data['query'] = $tree->where('spon_id', $user_id2)->get()->getResult();

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

            $user_id2 = $this->session->user_id_client;
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
//            $withwNaga = DB()->table('history_withdraw_nagad');
//            $data['nagad_trans'] = $withwNaga->where('receiver_id', $user_id2)->get()->getResult();
            $data['nagad_trans'] = [];

            //query nagad transection list for this user
            $withwpm = DB()->table('history_withdraw_pm');
            $data['PM_trans'] = $withwpm->where('receiver_id', $user_id2)->get()->getResult();

            $tree = DB()->table('tree');
            $data['query'] = $tree->where('ref_id', $user_id2)->get()->getResult();

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

            $user_id2 = $this->session->user_id_client;
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
            $data['with_match'] = $withw->where('form', $user_id2)->get()->getResult();

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

            $user_id2 = $this->session->user_id_client;
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
            $comm_matching->where('u_id', $user_id2)->get()->getResult();
            $data['querya'] = $comm_matching->where('u_id', $user_id2)->get()->getResult();

            $comNum = DB()->table('comm_matching');
            $data['com_taken_matching'] = $comNum->where('u_id', $user_id2)->countAllResults();

            $commsum = DB()->table('comm_matching');
            $data['total_matching_amount'] = $commsum->selectSum('amount')->where('u_id', $user_id2)->get();


            echo view('Front/Client_area/Member/matching_report', $data);
            echo view('Front/Client_area/footer', $data);
        }
    }

    public function sponser_report($user_id = 0)
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

            $user_id2 = $this->session->user_id_client;
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

            $comm_spot = DB()->table('comm_spot');
            $data['querya'] = $comm_spot->where('u_id', $user_id2)->get()->getResult();


            echo view('Front/Client_area/Member/sponser_report', $data);
            echo view('Front/Client_area/footer', $data);
        }
    }

    public function pin_generate()
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

            $user_id2 = $this->session->user_id_client;
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
            $data['user_id'] = $user_id2;

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            echo view('Front/Client_area/header', $data);

            $pins = DB()->table('pins');
            $data['query'] = $pins->where('generated_by', $user_id2)->get()->getResult();

            $pack = DB()->table('package');
            $data['package'] = $pack->get()->getResult();

            echo view('Front/Client_area/Member/pin_generate', $data);
            echo view('Front/Client_area/footer', $data);
        }
    }

    public function pin_generat_action()
    {

        $user_id = $this->session->user_id_client;
        $num_pins = $this->request->getPost('amount');
        $packageId = $this->request->getPost('package_id');
        $balance = get_id_by_data('balance', 'users', 'ID', $user_id);
        $packAmount = get_id_by_data('price', 'package', 'package_id', $packageId);
        $totalPrice = $packAmount * $num_pins;

        if ($balance >= $totalPrice) {

            for ($i = 1; $i <= $num_pins; $i++) {
                $pin = $this->generate();
                $data = [
                    'package_id' => $packageId,
                    'generated_by' => $user_id,
                    'pin' => $pin,
                ];
                $table = DB()->table('pins');
                $table->insert($data);
            }

            //package update
            $oldPack = get_id_by_data('total_pin_generated_number', 'package', 'package_id', $packageId);
            $newPin = $oldPack + $num_pins;
            $data = ['total_pin_generated_number' => $newPin];
            $pack = DB()->table('package');
            $pack->where('package_id', $packageId)->update($data);

            //user balance update
            $newBalUser = $balance - $totalPrice;
            $tUser = DB()->table('users');
            $tUser->where('ID', $user_id)->update(['balance' => $newBalUser]);



            //user balance history update
            $histData = array(
                'user_id' => $user_id,
                'amount' => $totalPrice,
                'type' => 'CR',
                'purpose' => 'Pin generate',
            );
            $history = DB()->table('history_balance');
            $history->insert($histData);


            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
            return redirect()->to(site_url("/Member/General/pin_generate"));
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Sorry your load balance is not enough!</div>');
            return redirect()->to(site_url("/Member/General/pin_generate"));
        }
    }

    public function generate()
    {
//        $pins = rand(1, 1000000);
        $pins = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(20))), 0, 20);
        return $pins;
    }


}

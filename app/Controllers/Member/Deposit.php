<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;
use CodeIgniter\Cookie\Cookie;

class Deposit extends BaseController
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



                $tree = DB()->table('video');
                $sqlTre = $tree->where('status', '1')->get();
                $data['query'] = $sqlTre->getResult();

                $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
                echo view('Front/Client_area/header', $data);
                echo view('Front/Client_area/Member/video_list', $data);
                echo view('Front/Client_area/footer', $data);
            }


        }
    }



    public function deposit_status(){
//        $payee_account = encrypt_decrypt($this->request->getPost('PAYEE_ACCOUNT'), "decrypt");
//        $payment_id = encrypt_decrypt($this->request->getPost('PAYMENT_ID'), "decrypt");
//        $user_id = encrypt_decrypt($this->request->getPost('USER_ID'), "decrypt");
//        $payment_amount = $this->request->getPost('PAYMENT_AMOUNT');
//        $payment_units = $this->request->getPost('PAYMENT_UNITS');
//        $suggested_memo = $this->request->getPost('SUGGESTED_MEMO');
//        //$payee_name = $this->request->getPost('PAYEE_NAME');
//
//        if (($payee_account == 'U15536991') && (!empty($payment_amount)) && (!empty($user_id))){
//
//            DB()->transStart();
//
//            // Balance update start.
//            $balance = get_balance_by_id($user_id);
//            $update_balance = array(
//                'balance' => $balance + $payment_amount
//            );
//            $treeUp = DB()->table('users');
//            $treeUp->where('ID', $user_id)->update($update_balance);
//            // Balance update end.
//
//            // Deposit history start.
//            $data_personal = array(
//                'payee_account' => $payee_account,
////                'payee_name' => $payee_name,
//                'payer_account' => $user_id,
//                'payment_id' => $payment_id,
//                'amount' => $payment_amount,
//                'payment_units' => $payment_units,
//                'suggested_memo' => $suggested_memo
//            );
//
//            $users = DB()->table('history_deposit_pm');
//            $users->insert($data_personal);
//            // Deposit history end
//
//            DB()->transComplete();
//        }
    }

    public function payment_success(){
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
//                $data['check_user'] = $clientLogin;
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
                echo view('Front/Client_area/Member/payment', $data);
                echo view('Front/Client_area/footer', $data);
            }
        }
    }


    public function payment(){
        // Codes after successful of payment start
        $payee_account = $this->request->getPost('PAYEE_ACCOUNT');
        $payment_id = encrypt_decrypt($this->request->getPost('PAYMENT_ID'), "decrypt");
        $user_id = encrypt_decrypt($this->request->getPost('USER_ID'), "decrypt");
        $payment_amount = $this->request->getPost('PAYMENT_AMOUNT');
        $payment_units = $this->request->getPost('PAYMENT_UNITS');
        $suggested_memo = $this->request->getPost('SUGGESTED_MEMO');
        $packageID = $this->request->getPost('PACKAGEID');
        //$payee_name = $this->request->getPost('PAYEE_NAME');

        $new_session = \Config\Services::session();
        $sessionArray = array(
            'user_id_client' => $user_id,
            'role_client' => get_data_by_id("roleID","user_roles", "userID", $user_id),
            'username_client' => get_username_byID($user_id),
            'user_package' => $packageID,
            'isLoggedInClient' => TRUE
        );
        $new_session->set($sessionArray);

        if (($payee_account == 'U15536991') && (!empty($payment_amount)) && (!empty($user_id))){

            DB()->transStart();

            // Balance update start.
            $balance = get_balance_by_id($user_id);
            $update_balance = array(
                'balance' => $balance + $payment_amount
            );
            $treeUp = DB()->table('users');
            $treeUp->where('ID', $user_id)->update($update_balance);
            // Balance update end.

            // Deposit history start.
            $data_personal = array(
                'payee_account' => $payee_account,
//              'payee_name' => $payee_name,
                'payer_account' => $user_id,
                'payment_id' => $payment_id,
                'amount' => $payment_amount,
                'payment_units' => $payment_units,
                'suggested_memo' => $suggested_memo
            );

            $users = DB()->table('history_deposit_pm');
            $users->insert($data_personal);
            // Deposit history end

            DB()->transComplete();

            return redirect()->to(site_url("member/dashboard/user_active_by_payment"));
        }else {
            return redirect()->to(site_url("Member/Deposit/payment_unsuccess"));
        }
        // Codes after successful of payment end
    }


    public function no_payment(){

        $user_id = encrypt_decrypt($this->request->getPost('USER_ID'), "decrypt");
        $new_session = \Config\Services::session();
        $sessionArray = array(
            'user_id_client' => $user_id,
            'role_client' => get_data_by_id("roleID","user_roles", "userID", $user_id),
            'username_client' => get_username_byID($user_id),
            'isLoggedInClient' => TRUE
        );
        $new_session->set($sessionArray);
        return redirect()->to(site_url("Member/Deposit/payment_unsuccess"));

    }

    public function payment_unsuccess(){

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
//                $data['check_user'] = $clientLogin;
                $data['ID'] = $user_id;
                $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id);
                $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id);
                $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id);
                $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
                $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id);
                $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id);
                $data['user_id'] = $user_id;



                $tree = DB()->table('video');
                $sqlTre = $tree->where('status', '1')->get();
                $data['query'] = $sqlTre->getResult();

                $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
                echo view('Front/Client_area/header', $data);
                echo view('Front/Client_area/Member/no_payment', $data);
                echo view('Front/Client_area/footer', $data);
            }
        }
    }






}

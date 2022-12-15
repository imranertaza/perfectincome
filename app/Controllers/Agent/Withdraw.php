<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;
use App\Models\Users\UserLoginModel;

class Withdraw extends BaseController
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


            $data['sidebar_left'] = view('Front/Client_area/agent_sidebar_left', $data);
            echo view('Front/Client_area/header', $data);
            echo view('Front/Client_area/Agent/agent_withdraw', $data);
            echo view('Front/Client_area/footer', $data);
        } else {
            return redirect()->to(site_url("Agent/Login"));
        }


    }

    public function list(){
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

            $withdraw = DB()->table('history_transection_agent');
            $query = $withdraw->where('receiver_id',$user_id)->orderBy('history_agent_tran_id','DESC')->get();
            $data['withdrawData'] = $query->getResult();


            $data['sidebar_left'] = view('Front/Client_area/agent_sidebar_left', $data);
            echo view('Front/Client_area/header', $data);
            echo view('Front/Client_area/Agent/withdraw_list', $data);
            echo view('Front/Client_area/footer', $data);
        } else {
            return redirect()->to(site_url("Agent/Login"));
        }
    }

    public function withdraw_action(){
        $user_id = $this->session->agent_id;
        $withdraw_amount = $this->request->getPost('withdraw_amount');
        $number = $this->request->getPost('nagad_number');
        $countNum =  strlen($number);

        if ((!empty($number)) && ($countNum == 11)){
            $user_status = get_field_by_id_from_table('users', 'status', 'ID', $user_id);
            $maxWithdrawPerDay = get_field_by_id_from_table('global_settings', 'value', 'title', 'maxWithdrawPerDayAgent');
            $minWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'minWithdrawPerTimeAgent');
            $maxWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'maxWithdrawPerTimeAgent');


            $today = date("Y-m-d");
            $tomorrow = date("Y-m-d", strtotime('tomorrow'));
            $historyWithdrawTable = DB()->table('history_transection_admin');
            $totalWithdrawToday = $historyWithdrawTable->where(array("sender_id" => $user_id, "createdDtm >=" => $today, "createdDtm <" => $tomorrow))->countAllResults();


            $oldBal = get_data_by_id('balance', 'users', 'ID', $user_id);
            if (($withdraw_amount >= $minWithdrawPerTime) && ($withdraw_amount <= $maxWithdrawPerTime) && ($maxWithdrawPerDay >= $totalWithdrawToday) && ($user_status === 'Active') && ($oldBal >= $withdraw_amount)) {
                DB()->transStart();

                $transData = [
                    'sender_id' => $user_id,
                    'receiver_id' => ADMIN_ID,
                    'nagad_number' => $number,
                    'purpose' => 'Money Withdraw by Admin',
                    'amount' => $withdraw_amount,
                ];
                $transectionTable = DB()->table('history_transection_admin');
                $transectionTable->insert($transData);


                //balance update
                $newBal = $oldBal - $withdraw_amount;
                $userBalUpdate = [
                    'balance' => $newBal,
                ];
                $userTable = DB()->table('users');
                $userTable->where('ID', $user_id)->update($userBalUpdate);

                DB()->transComplete();

                $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-success">Your withdraw is successful.</div>');
                return redirect()->to(site_url("Agent/Withdraw"));
            } else {
                $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-danger">something went wrong please try again.</div>');
                return redirect()->to(site_url("Agent/Withdraw"));
            }
        }else{
            $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-danger">Please input correct nagad account number!</div>');
            return redirect()->to(site_url("Agent/Withdraw"));
        }
    }

    public function withdraw_list(){
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

            $withdraw = DB()->table('history_transection_admin');
            $query = $withdraw->where('sender_id',$user_id)->get();
            $data['withdrawData'] = $query->getResult();


            $data['sidebar_left'] = view('Front/Client_area/agent_sidebar_left', $data);
            echo view('Front/Client_area/header', $data);
            echo view('Front/Client_area/Agent/agent_withdraw_list', $data);
            echo view('Front/Client_area/footer', $data);
        } else {
            return redirect()->to(site_url("Agent/Login"));
        }
    }


}

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
            echo view('Front/Client_area/Member/team', $data);
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
            $data['session'] = $this->session;

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


    public function withdraw_action()
    {
        $clientLogin = $this->session->isLoggedInClient;
        if (!isset($clientLogin) || $clientLogin != TRUE) {
            return redirect()->to(site_url("Member_form/login"));
        } else {
            $user_id = $this->session->user_id_client;
            $user_status = get_field_by_id_from_table('users', 'status', 'ID', $user_id);

            $withdraw_amount = $this->request->getPost('withdraw_amount');
            $Payee_Account = $this->request->getPost('payee_account');

            $maxWithdrawPerDay = get_field_by_id_from_table('global_settings', 'value', 'title', 'maxWithdrawPerDay');
            $minWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'minWithdrawPerTime');
            $maxWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'maxWithdrawPerTime');
            $AccountID = get_field_by_id_from_table('global_settings', 'value', 'title', 'PerfectMoney_Account_ID');
            $PassPhrase = get_field_by_id_from_table('global_settings', 'value', 'title', 'PerfectMoney_Password');
            $Payer_Account = get_field_by_id_from_table('global_settings', 'value', 'title', 'PerfectMoney_Payer_Account');
            $PAY_IN = 1;


            // Finding total withdraw this day from history_withdraw_pm table (Start)
            $today = date("Y-m-d");
            $tomorrow = date("Y-m-d", strtotime('tomorrow'));
            $historyWithdrawTable = DB()->table('history_withdraw_pm');
            $totalWithdrawToday = $historyWithdrawTable->where(array("receiver_id" => $user_id, "createdDtm >=" => $today, "createdDtm <" => $tomorrow))->countAllResults();
            // Finding total withdraw this day from history_withdraw_pm table (End)



            $oldBal = get_data_by_id('balance','users','ID',$user_id);
            if (($withdraw_amount >= $minWithdrawPerTime) && ($withdraw_amount <= $maxWithdrawPerTime) && ($maxWithdrawPerDay >= $totalWithdrawToday) && ($user_status === 'Active') && ($oldBal >= $withdraw_amount)) {

                // update user balance
                $newBal = $oldBal - $withdraw_amount;
                $userTabl = DB()->table('users');
                $uData = [
                    'balance' => $newBal,
                ];
                $userTabl->where('ID', $user_id)->update($uData);


                // Adding to history_withdraw_pm (Start)
                $historyInsertData = [
                    'receiver_id' => $user_id,
                    'Payee_Account' => $Payee_Account,
                    'status' => 'Pending',
                    'amount' => $withdraw_amount,
                    'rest_balance' => $newBal,
                ];
                $historyWithdrawTable->insert($historyInsertData);

                //$PAYMENT_ID = DB()->insertID();
                // Adding to history_withdraw_pm (End)


                //             $api_url = 'https://perfectmoney.com/acct/confirm.asp?AccountID='.$AccountID.'&PassPhrase='.$PassPhrase.'&Payer_Account='.$Payer_Account.'&Payee_Account='.$Payee_Account.'&Amount='.$withdraw_amount.'&PAY_IN='.$PAY_IN.'&PAYMENT_ID='.$PAYMENT_ID;
                // trying to open URL to process PerfectMoney Spend request
//                $f = fopen('https://perfectmoney.com/acct/confirm.asp?AccountID=' . $AccountID . '&PassPhrase=' . $PassPhrase . '&Payer_Account=' . $Payer_Account . '&Payee_Account=' . $Payee_Account . '&Amount=' . $withdraw_amount . '&PAY_IN=' . $PAY_IN . '&PAYMENT_ID=' . $PAYMENT_ID, 'rb');
//
//                if ($f === false) {
////                    echo 'error openning url';
//                    $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-danger">Error Openning URL</div>');
//                    return redirect()->to(site_url("Member/general/withdraw"));
//                }

                // getting data
//                $out = array();
//                $out = "";
//                while (!feof($f)) $out .= fgets($f);
//                fclose($f);
//
//
//
//                // searching for hidden fields (Start)
//                if (!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)) {
////                    echo 'Ivalid output';
//                    $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-danger">Ivalid output</div>');
//                    return redirect()->to(site_url("Member/general/withdraw"));
//                    exit;
//                }
                // searching for hidden fields (End)


                // Message if payment fails because of not enough money (Start)
//                if ($result[0][1] === 'ERROR'){
//                    $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-danger">'.$result[0][2].'</div>');
//                    return redirect()->to(site_url("Member/general/withdraw"));
//                    exit;
//                }
                // Message if payment fails because of not enough money (End)


                // Updating some information to history_withdraw_pm Start
//                $historyWithdrawTable = DB()->table('history_withdraw_pm');
//                $historyUpdateData = [
//                    'Payee_Account_Name' => $result[0][2],
//                    'batch_number' => $result[4][2],
//                    'status' => 'Success',
//                ];
//                $historyWithdrawTable->where('withdraw_id', $PAYMENT_ID)->update($historyUpdateData);
//                // Updating some information to history_withdraw_pm End
//
//
//
//                // Deducting balance from user's account Start
//                $old_balance = get_field_by_id_from_table('users', 'balance', 'ID', $user_id);
//                $newBalance = $old_balance - $withdraw_amount;
//                $userTable = DB()->table('users');
//                $userTable->where('ID', $user_id)->update(['balance' => $newBalance]);
                // Deducting balance from user's account End


                $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-success">Your withdraw is successful.</div>');
                return redirect()->to(site_url("Member/general/withdraw"));

//                $ar = "";
//                print_r($result);
//                foreach ($result as $row) {
//                    print_r($row);
//                    foreach ($row as $item){
//                        $key = $item[1];
//                        $ar[$key] = $item[2];
//                    }
//                }

                //            Payee_Account_Name	imranertaza
                //            Payee_Account	U33655967
                //            Payer_Account	U15536991
                //            PAYMENT_AMOUNT	1
                //            PAYMENT_BATCH_NUM	438827148
                //            PAYMENT_ID	1285

            } else {
                $this->session->setFlashdata('withdraw_msg', '<div class="alert alert-danger">Wrong input to withdraw.</div>');
                return redirect()->to(site_url("Member/general/withdraw"));
            }
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

            $withw = DB()->table('history_withdraw_pm');
            $data['with_match'] = $withw->where('receiver_id', $user_id2)->get()->getResult();
//            print DB()->getLastQuery();

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

//    public function pin_generate()
//    {
//        $clientLogin = $this->session->isLoggedInClient;
//        if (!isset($clientLogin) || $clientLogin != TRUE) {
//            return redirect()->to(site_url("Member_form/login"));
//        } else {
//            $data['globalSettingsModel'] = $this->globalSettingsModel;
//
//            $data['dwn_path'] = base_url() . "/uploads/downloads/";
//            $downloads = DB()->table('downloads');
//
//            $sdow = $downloads->where('cat_id', '5')->get();
//            $notice_list = $sdow->getResult();
//
//            $downl = DB()->table('downloads');
//            $notiCount = $downl->where('cat_id', '5')->countAllResults();
//            if ($notiCount > 0) {
//                $data['list_notice'] = $notice_list;
//            } else {
//                $data['list_notice'] = 'No notice published';
//            }
//
//            $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
//            $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);
//
//            $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
//            $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);
//
//            $data['page_title'] = 'home';
//            $data['slider'] = '';
//
//            $user_id2 = $this->session->user_id_client;
//            $data['log_url'] = 'member_form/logout';
//            $data['log_title'] = 'Logout';
//            $data['check_user'] = $clientLogin;
//            $data['ID'] = $user_id2;
//            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $user_id2);
//            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $user_id2);
//            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $user_id2);
//            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $user_id2);
//            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $user_id2);
//            $data['lpoint'] = get_field_by_id_from_table('users', 'lpoint', 'ID', $user_id2);
//            $data['rpoint'] = get_field_by_id_from_table('users', 'rpoint', 'ID', $user_id2);
//            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $user_id2);
//            $data['user_id'] = $user_id2;
//
//            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
//            echo view('Front/Client_area/header', $data);
//
//            $pins = DB()->table('pins');
//            $data['query'] = $pins->where('generated_by', $user_id2)->get()->getResult();
//
//            $pack = DB()->table('package');
//            $data['package'] = $pack->get()->getResult();
//
//            echo view('Front/Client_area/Member/pin_generate', $data);
//            echo view('Front/Client_area/footer', $data);
//        }
//    }
//
//    public function pin_generat_action()
//    {
//
//        $user_id = $this->session->user_id_client;
//        $num_pins = $this->request->getPost('amount');
//        $packageId = $this->request->getPost('package_id');
//        $balance = get_id_by_data('balance', 'users', 'ID', $user_id);
//        $packAmount = get_id_by_data('price', 'package', 'package_id', $packageId);
//        $totalPrice = $packAmount * $num_pins;
//
//        if ($balance >= $totalPrice) {
//
//            for ($i = 1; $i <= $num_pins; $i++) {
//                $pin = $this->generate();
//                $data = [
//                    'package_id' => $packageId,
//                    'generated_by' => $user_id,
//                    'pin' => $pin,
//                ];
//                $table = DB()->table('pins');
//                $table->insert($data);
//            }
//
//            //package update
//            $oldPack = get_id_by_data('total_pin_generated_number', 'package', 'package_id', $packageId);
//            $newPin = $oldPack + $num_pins;
//            $data = ['total_pin_generated_number' => $newPin];
//            $pack = DB()->table('package');
//            $pack->where('package_id', $packageId)->update($data);
//
//            //user balance update
//            $newBalUser = $balance - $totalPrice;
//            $tUser = DB()->table('users');
//            $tUser->where('ID', $user_id)->update(['balance' => $newBalUser]);
//
//
//            //user balance history update
//            $histData = array(
//                'user_id' => $user_id,
//                'amount' => $totalPrice,
//                'type' => 'CR',
//                'purpose' => 'Pin generate',
//            );
//            $history = DB()->table('history_balance');
//            $history->insert($histData);
//
//
//            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
//            return redirect()->to(site_url("/Member/General/pin_generate"));
//        } else {
//            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Sorry your load balance is not enough!</div>');
//            return redirect()->to(site_url("/Member/General/pin_generate"));
//        }
//    }

    public function generate()
    {
//        $pins = rand(1, 1000000);
        $pins = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(20))), 0, 20);
        return $pins;
    }


}

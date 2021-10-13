<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Agent_pin extends BaseController
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
            $userId = $this->session->user_id;
            if (($clientLogin == true) && ($role == 4)) {
                $data['log_url'] = 'member_form/logout';
                $data['log_title'] = 'Logout';
                $data['check_user'] = $clientLogin;
                $data['ID'] = $this->session->user_id;
                $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $userId);
                $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $userId);
                $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $userId);
                $data['gameBalance'] = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $userId);
                $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $userId);
                $data['Point'] = get_field_by_id_from_table('users', 'point', 'ID', $userId);
                $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $userId);
                $data['user_id'] = $this->session->user_id;

                $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
                echo view('Front/Client_area/header', $data);


                $users = DB()->table('users');
                $sqlUs = $users->where('ID', $this->session->user_id)->get();
                $query = $sqlUs->getRow();
                $data['row'] = $query;


                $pin = DB()->table('pins');
                $data['agentInfo'] = $pin->where('user_id', $this->session->user_id)->get()->getResult();


                echo view('Front/Client_area/Agent/pin_generate', $data);
                echo view('Front/Client_area/footer', $data);


            } else {
                return redirect()->to(site_url("Member/dashboard"));
            }


        }
    }


    public function pin_generat_action()
    {

        $ID = $this->session->user_id;
        $pinAmount = $this->request->getPost('amount');
        $balance = get_field_by_id_from_table('users', 'balance', 'ID', $ID);
        $Commissionbalance = get_field_by_id_from_table('users', 'commission', 'ID', $ID);
        $registration_amount = get_field_by_id_from_table('global_settings', 'value', 'title', 'registration_amount');
        $adminBalance = get_field_by_id_from_table('users', 'balance', 'ID', 1);

        $agent_commission = get_field_by_id_from_table('global_settings', 'value', 'title', 'agent_commission');

        //Amount Generate
        $totalAmount = $registration_amount * $pinAmount;
        //Updated Data
        $UpdateBalance = $balance - $totalAmount;
        //Update Admin balance
        $totalAdminBalance = $adminBalance + $totalAmount;

        if ($balance >= $totalAmount) {

            $num_pins = $this->request->getPost('amount');

            //Balance Update
            $balanceData = array(
                'balance' => $UpdateBalance,
            );
            $userUpbal = DB()->table('users');
            $userUpbal->where('ID', $ID) ->update($balanceData);

            //Update Admin balance
            $adminBalanceData = array(
                'balance' => $totalAdminBalance,
            );
            $adBalUp = DB()->table('users');
            $adBalUp->where('ID', 1)->update($adminBalanceData);

            //pin generate
            for ($i = 1; $i <= $num_pins; $i++) {

                //Pin Generate
                $pin = $this->generate();
                $data = array(
                    'user_id' => $ID,
                    'pin' => $pin,
                );
                $inPin = DB()->table('pins');
                $inPin->insert($data);

                //history_balance_agent
                $hisBalanceAgent = array(
                    'user_id' => $ID,
                    'amount' => $registration_amount,
                    'type' => 'CR',
                    'purpose' => 'Pin generate',
                );
                $hisBalAg = DB()->table('history_balance_agent');
                $hisBalAg->insert($hisBalanceAgent);

                //history_balance_admin
                $hisBalanceadmin = array(
                    'user_id' => 1,
                    'amount' => $registration_amount,
                    'type' => 'DR',
                    'purpose' => 'Pin generate',
                );
                $hisBalAdm = DB()->table('history_balance_admin');
                $hisBalAdm->insert($hisBalanceadmin);
            }

            //Amount Generate
            $totalAmountcommission = $agent_commission * $pinAmount;

            //Update Admin balance CR
            $totalAdminBalancecommission = $totalAdminBalance - $totalAmountcommission;
            $adminBalanceDatacommission = array(
                'balance' => $totalAdminBalancecommission,
            );
            $adUsCom = DB()->table('users');
            $adUsCom->where('ID', 1)->update($adminBalanceDatacommission);


            //Balance Update Agent commission
            $UpdateBalanceagentcomm = $Commissionbalance + $totalAmountcommission;
            $balanceDataagentCommission = array(
                'commission' => $UpdateBalanceagentcomm,
            );
            $balAgCom = DB()->table('users');
            $balAgCom->where('ID', $ID)->update($balanceDataagentCommission);


            // history commission
            for ($i = 1; $i <= $num_pins; $i++) {
                //history_balance_agent_commission
                $hisBalanceAgentcommission = array(
                    'user_id' => $ID,
                    'amount' => $agent_commission,
                    'type' => 'DR',
                    'purpose' => 'Pin generate commission',
                );
                $hisBalAgn = DB()->table('history_balance_agent');
                $hisBalAgn->insert($hisBalanceAgentcommission);

                //history_balance_admin_commission
                $hisBalanceadmincommission = array(
                    'user_id' => 1,
                    'amount' => $agent_commission,
                    'type' => 'CR',
                    'purpose' => 'Pin generate commission',
                );
                $hisBalAdmin = DB()->table('history_balance_admin');
                $hisBalAdmin->insert($hisBalanceadmincommission);
            }


            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Pin generate successfully</div>');
            return redirect()->to(site_url("Agent/agent_pin"));

        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Sorry! No Balance Available</div>');
            return redirect()->to(site_url("Agent/agent_pin"));
        }


    }

    public function generate()
    {
        $pins = rand(1, 1000000);
        return $pins;
    }


}

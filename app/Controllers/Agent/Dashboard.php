<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Dashboard extends BaseController
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
            $sdow = $downloads->where('cat_id','5')->get();
            $notice_list = $sdow->getResult();

            $downl = DB()->table('downloads');
            $notiCount = $downl->where('cat_id','5')->countAllResults();
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
                $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID',$userId);
                $data['gameBalance'] = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $userId);
                $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $userId);
                $data['Point'] = get_field_by_id_from_table('users', 'point', 'ID', $userId);
                $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID',$userId);
                $data['user_id'] = $this->session->user_id;

                $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
                echo view('Front/Client_area/header', $data);

                $users = DB()->table('users');
                $sqlUs = $users->where('ID',$this->session->user_id)->get();
                $query = $sqlUs->getRow();

                $data['profile'] = $query;

                $tree = DB()->table('tree');
                $tree->select('users.*');
                $tree->join('users', 'users.ID = tree.u_id');
                $tree->where('tree.agent_id',$this->session->user_id);
                $data['query'] = $tree->get()->getResult();

                $sales = DB()->table('sales');
                $sqlSale = $sales->where('agent_id',$this->session->user_id)->limit(15)->get();
                $data['querya'] = $sqlSale->getResult();


                echo view('Front/Client_area/Agent/dashboard', $data);
                echo view('Front/Client_area/footer', $data);
            }else{
                return redirect()->to(site_url("Member/dashboard"));
            }


        }
    }


}

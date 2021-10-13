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

    public function register_action(){
        $position = $this->request->getPost('position');
        if (($position == 1) || ($position == 2)) {

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
                'agent_id' => $pid,
                'spon_id' => $spon_id
            );
            $tree = DB()->table('tree');
            $tree->insert($data_tree);;

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
            $treeUp->where('u_id',$pid)->update($data_left_right);



            //pin update
            $pin = array(
                'status'=>'used'
            );
            $pins = DB()->table('pins');
            $pins->where('pin',$this->request->getPost('pin'))->update($pin);

            //Sponsor commision will be added to main Commission
            $spon_id = get_field_by_id_from_table("tree", "spon_id", "u_id", $userID);
            $spons_previous_bal = get_field_by_id_from_table("users", "commission", "ID", $spon_id);
            $sponsor_com = get_field_by_id_from_table("global_settings", "value", "title", "sponsor_commission");
            $sponsor_commision = array(
                'commission' => $spons_previous_bal + $sponsor_com,
            );

            $userCom = DB()->table('users');
            $userCom->where('ID', $spon_id)->update($sponsor_commision);


            // Sponsor commission Statement
            $spon_commision_statement = array(
                'u_id' => $spon_id,
                'purpose' => "Sponsor commission of a register new member",
                'amount' => $sponsor_com,
                'date' => date("Y-m-d h:i:s")
            );
            $comm_spot = DB()->table('comm_spot');
            $comm_spot->insert($spon_commision_statement);



            //sponsor commision is deducting from admin balance
            $adminBalance = get_field_by_id_from_table('users', 'balance', 'ID', 1);
            $adminBalanceCRspon = $adminBalance-$sponsor_com;
            $adminBalanceCRdataspon = array(
                'balance' => $adminBalanceCRspon,
            );
            $adminCm = DB()->table('users');
            $adminCm->where('ID', 1)->update($adminBalanceCRdataspon);



            //admin balance history
            $hisBalanceadminspon = array(
                'user_id' => 1,
                'amount' => $sponsor_com,
                'type' => 'CR',
                'purpose'=>'spon_commission',
            );
            $hisBalAdmin = DB()->table('history_balance_admin');
            $hisBalAdmin->insert($hisBalanceadminspon);



            //All Users Perent_point will be increased And matching
            $min_matching_point = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");
            $per_day_matching = get_field_by_id_from_table("global_settings", "value", "title", "per_day_matching");
            $matching_commission = get_field_by_id_from_table("global_settings", "value", "title", "matching_commission");

            $parent_id = get_field_by_id_from_table("tree", "pr_id", "u_id", $userID);
            $user_id = $userID;

            while (!empty($parent_id)) {

                $old_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                $old_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

                //Increasing Parent hand Point (left or right)
                $treeHand = DB()->table('tree');
                $hand = $treeHand->where('u_id',$parent_id)->get()->getRow();

                if ($hand->l_t == $user_id) {
                    $point_hand = "lpoint";
                }
                if ($hand->r_t == $user_id) {
                    $point_hand = "rpoint";
                }
                $old_point = get_field_by_id_from_table("users", $point_hand, "ID", $parent_id);
                $pr_point = array(
                    $point_hand => $old_point + $min_matching_point
                );
                $userPoi = DB()->table('users');
                $userPoi->where('ID',$parent_id)->update($pr_point);

                //Adding history of points
                $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
                $current_commission = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
                $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
                $history_point_data = array(
                    'u_id' => $parent_id,
                    $point_hand => $min_matching_point,
                    'current_left_point' => $current_lpoint,
                    'current_right_point' => $current_rpoint,
                    'current_commission' => $current_commission,
                    'current_balance' => $current_balance,
                    'type' => "Add",
                    'date' => date("Y-m-d h:i:s")
                );
                $hisPoinTbl = DB()->table('history_point');
                $hisPoinTbl->insert($history_point_data);





                //Matching Commission
                $comMatch = DB()->table('comm_matching');
                $com_taken_on_day = $comMatch->where('u_id',$parent_id)->where('date <',date("Y-m-d"))->countAllResults();


//                $com_taken_on_day = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = $parent_id AND `date` BETWEEN '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59'")->num_rows();
                if ($com_taken_on_day < $per_day_matching) {

                    $lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                    $rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

                    if (($lpoint >= $min_matching_point) && ($rpoint >= $min_matching_point) && !empty($hand->l_t) && !empty($hand->r_t)) {

                        $existing_com = get_field_by_id_from_table("users", "commission", "ID", $parent_id);

                        // Updating commission on user table
                        $data = array(
                            'commission' => $existing_com + $matching_commission
                        );
                        $userMetCom = DB()->table('users');
                        $userMetCom->where('ID', $parent_id)->update($data);

                        //$matching_commission;
                        $data = array(
                            'u_id' => $parent_id,
                            'purpose' => 'Matching Commission'.date("Y-m-d h:i:s A"),
                            'amount' => $matching_commission,
                            'date' => date("Y-m-d h:i:s")
                        );
                        $uComMetch = DB()->table('comm_matching');
                        $uComMetch->insert($data);


                        //matching_commission is deducting from admin balance
                        $adminBalanceNew = get_field_by_id_from_table('users', 'balance', 'ID', 1);
                        $adminBalanceCR = $adminBalanceNew - $matching_commission;
                        $adminBalanceCRdata = array(
                            'balance' => $adminBalanceCR,
                        );
                        $adBalCom = DB()->table('users');
                        $adBalCom->where('ID', 1)->update($adminBalanceCRdata);

                        //admin balance history
                        $hisBalanceadmin = array(
                            'user_id' => 1,
                            'amount' => $matching_commission,
                            'type' => 'CR',
                            'purpose'=>'matching_commission',
                        );
                        $hisAdBal = DB()->table('history_balance_admin');
                        $hisAdBal->insert($hisBalanceadmin);





                        //Decreasing Left Point
                        //$matching_point = $next_com_times * $min_matching_point;
                        $left_data = array(
                            'lpoint' => $lpoint - $min_matching_point,
                            'rpoint' => $rpoint - $min_matching_point
                        );
                        $lfUpdate = DB()->table('users');
                        $lfUpdate->where('ID', $parent_id)->update('users', $left_data);



                        //Deducting history of points
                        $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                        $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
                        $current_commission = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
                        $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
                        $deducting_point_data = array(
                            'u_id' => $parent_id,
                            'lpoint' => $min_matching_point,
                            'rpoint' => $min_matching_point,
                            'current_left_point' => $current_lpoint,
                            'current_right_point' => $current_rpoint,
                            'current_commission' => $current_commission,
                            'current_balance' => $current_balance,
                            'type' => "Deduct",
                            'date' => date("Y-m-d h:i:s")
                        );
                        $hisPoint = DB()->table('history_point');
                        $hisPoint->insert($deducting_point_data);

                    }

                }

                //Flash existing Point after 25
                //$total_comm_taken = $com_taken_on_day + 1;
                if ($com_taken_on_day >= $per_day_matching) {

                    if ($old_lpoint <> $old_rpoint) {
                        if ($old_lpoint > $old_rpoint) {
                            $flash_hand = "rpoint";
                        } else {
                            $flash_hand = "lpoint";
                        }

                        $flashdata = array(
                            $flash_hand => 0
                        );
                        $faUpTab = DB()->table('users');
                        $faUpTab->where('ID', $parent_id)->update($flashdata);

                        //Flushing history of points
                        $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                        $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
                        $current_commission = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
                        $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
                        $flushing_point_data = array(
                            'u_id' => $parent_id,
                            $flash_hand => $min_matching_point,
                            'current_left_point' => $current_lpoint,
                            'current_right_point' => $current_rpoint,
                            'current_commission' => $current_commission,
                            'current_balance' => $current_balance,
                            'type' => "Flush",
                            'date' => date("Y-m-d h:i:s")
                        );
                        $hPoiUp = DB()->table('history_point');
                        $hPoiUp->insert($flushing_point_data);

                    }

                }
                $user_id = $parent_id;
                $parent_id = get_field_by_id_from_table("tree", "pr_id", "u_id", $parent_id);
            }




            $this->session->setFlashdata('error', 'Successfully Registered. Please Login');
            return redirect()->to(site_url("/member_form/login"));

        }else {
            $this->session->setFlashdata('error', 'Email or password mismatch');
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
            return redirect()->to(site_url("agent/dashboard"));
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
            if ($this->session->role == 4) {
                return redirect()->to(site_url("agent/dashboard"));
            }
            return redirect()->to(site_url("Member/dashboard"));
        } else {
            $this->session->setFlashdata('error', 'Email or password mismatch');
            $this->login();
        }

    }

    public function logout(){
        $session = \Config\Services::session();

        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        unset($_SESSION['isLoggedInClient']);

        $session->destroy();
        return redirect()->to(site_url("/member_form/login"));
    }


}

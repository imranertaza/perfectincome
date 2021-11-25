<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Video extends BaseController
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

    public function active_user()
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

                echo view('Front/Client_area/Member/active', $data);
                echo view('Front/Client_area/footer', $data);
            }


        }
    }

    public function pin_active()
    {
        DB()->transStart();
        $userID = $this->session->user_id_client;
        $pinId = $this->request->getPost('pin');
        $pin = array(
            'status' => 'used',
            'used_by' => $userID
        );
        $pins = DB()->table('pins');
        $pins->where('pin', $pinId)->update($pin);

        $packageId = get_id_by_data('package_id','pins','pin',$pinId);


        //Sponsor commision will be added to main Commission
        $spon_id = get_field_by_id_from_table("tree", "spon_id", "u_id", $userID);
        $spons_previous_bal = get_field_by_id_from_table("users", "commission", "ID", $spon_id);
//        $sponsor_com = get_field_by_id_from_table("global_settings", "value", "title", "sponsor_commission");
        $sponsor_com = get_id_by_data('sponsor_commission','package','package_id',$packageId);
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
        $adminBalanceCRspon = $adminBalance - $sponsor_com;
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
            'purpose' => 'spon_commission',
        );
        $hisBalAdmin = DB()->table('history_balance_admin');
        $hisBalAdmin->insert($hisBalanceadminspon);


        //All Users Perent_point will be increased And matching
        $min_matching_point = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");
        $matching_commission = get_field_by_id_from_table("global_settings", "value", "title", "matching_commission");
        $point = get_id_by_data('point','package','package_id',$packageId);
        $per_day_matching = get_field_by_id_from_table("global_settings", "value", "title", "per_day_matching");

        $parent_id = get_field_by_id_from_table("tree", "pr_id", "u_id", $userID);
        $user_id = $userID;

        while (!empty($parent_id)) {

            $old_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
            $old_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

            //Increasing Parent hand Point (left or right)
            $treeHand = DB()->table('tree');
            $hand = $treeHand->where('u_id', $parent_id)->get()->getRow();

            if ($hand->l_t == $user_id) {
                $point_hand = "lpoint";
            }
            if ($hand->r_t == $user_id) {
                $point_hand = "rpoint";
            }


            $old_point = get_field_by_id_from_table("users", $point_hand, "ID", $parent_id);
            $pr_point = array(
                $point_hand => $old_point + $point
            );
            $userPoi = DB()->table('users');
            $userPoi->where('ID', $parent_id)->update($pr_point);

            //Adding history of points
            $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
            $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
            $current_commission = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
            $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
            $history_point_data = array(
                'u_id' => $parent_id,
                $point_hand => $point,
                'current_left_point' => $current_lpoint,
                'current_right_point' => $current_rpoint,
                'current_commission' => $current_commission,
                'current_balance' => $current_balance,
                'type' => "Add",
                'date' => date("Y-m-d h:i:s")
            );
            $hisPoinTbl = DB()->table('history_point');
            $hisPoinTbl->insert($history_point_data);


            //Matching Commission Start
            if ($current_lpoint > $current_rpoint){
                $total_matching_time = $current_rpoint/$min_matching_point;
            }else {
                $total_matching_time = $current_lpoint/$min_matching_point;
            }

            for($i=0; $i<=$total_matching_time; $i++){

            $whereBetween = ("`date` BETWEEN '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59'");
            $comMatch = DB()->table('comm_matching');
            $com_taken_on_day = $comMatch->where('u_id', $parent_id)->where($whereBetween)->countAllResults();


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

                    //Matching Commission History;
                    $data = array(
                        'u_id' => $parent_id,
                        'purpose' => 'Matching Commission' . date("Y-m-d h:i:s A"),
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
                        'purpose' => 'matching_commission',
                    );
                    $hisAdBal = DB()->table('history_balance_admin');
                    $hisAdBal->insert($hisBalanceadmin);


                    //Decreasing Point from both side
                    //$matching_point = $next_com_times * $min_matching_point;
                    $left_data = array(
                        'lpoint' => $lpoint - $min_matching_point,
                        'rpoint' => $rpoint - $min_matching_point
                    );
                    $lfUpdate = DB()->table('users');
                    $lfUpdate->where('ID', $parent_id)->update($left_data);


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

            }
            //Matching Commission End


            //Flash existing Point after 100
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

        $uStatus = array(
            'status' => 'Active'
        );
        $stUser = DB()->table('users');
        $stUser->where('ID', $userID)->update($uStatus);

        DB()->transComplete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Successfully active!</div>');
        return redirect()->to(site_url("member/dashboard"));
    }

    public function view_video(){

        $videoId = $this->request->getPost('id');
        $userId = $this->session->user_id_client;


        //previous data delete
        $today = date('Y-m-d');
        $preDate = date('Y-m-d', strtotime($today . ' -1 day'));
        $viVewCo = DB()->table('video_view_count');
        $countRow = $viVewCo->where('u_id',$userId)->where('date',$preDate)->countAllResults();

        if(!empty($countRow)){
            $viVewCoDel = DB()->table('video_view_count');
            $viVewCoDel->where('u_id',$userId)->where('date',$preDate)->delete();
        }

        $video = DB()->table('video');
        $query = $video->where('video_id',$videoId)->get()->getRow();
        $view = '<div class="modal-header">
                <h4 class="modal-title">'.$query->title .'</h4>
                <p id="minCount" style="text-align: right;"></p>
                <button type="button" class="btn btn-success btn-sm" id="closeBtn" onclick="closeModal('.$query->video_id.')" style="display: none;">Close</button>
            </div>';
        $view .= '<div class="modal-body text-center" >'.$query->vi_url .'</div>';

        print $view;
    }

    public function view_video_count(){
        $videoId = $this->request->getPost('id');
        $userId = $this->session->user_id_client;
        $today = date('Y-m-d');

        $data['date'] = $today;
        $data['video_id'] = $videoId;
        $data['u_id'] = $userId;

        $viVewCo = DB()->table('video_view_count');
        $viVewCo->insert($data);


        //video earning
        $viVewCone = DB()->table('video_view_count');
        $countRow = $viVewCone->where('u_id',$userId)->where('date',$today)->countAllResults();
        $parDayView = get_global_settings_value('per_day_video_watch');
        $parDayEarn = get_global_settings_value('per_day_video_watch_earning');

        if ($countRow == $parDayView){
            $oldBal = get_id_by_data('balance','users','ID',$userId);
            $total = $parDayView * $parDayEarn;
            $restBal = $oldBal + $total;
            $usData = ['balance' => $restBal];
            $user = DB()->table('users');
            $user->where('ID',$userId)->update($usData);



            //commission video
            $comData = ['u_id' => $userId,'purpose' => 'Video view Earning','amount'=> $total,'date' => $today ];
            $comVideo = DB()->table('comm_video');
            $comVideo->insert($comData);
        }

        return 1;
    }


}

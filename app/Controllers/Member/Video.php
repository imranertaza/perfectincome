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

                $data['sidebar_left'] = view('Theme/'.selected_theme().'/Front/Client_area/sidebar-left', $data);
                echo view('Theme/'.selected_theme().'/Front/Client_area/header', $data);
                echo view('Theme/'.selected_theme().'/Front/Client_area/Member/video_list', $data);
                echo view('Theme/'.selected_theme().'/Front/Client_area/footer', $data);
            }


        }
    }



    public function view_video($video_id){

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



            //video content

//        $videoId = $this->request->getPost('id');
            $videoId = $video_id;
            $userId = $this->session->user_id_client;


            //previous data delete
            $today = date('Y-m-d');
            $viVewCo = DB()->table('video_view_count');
            $countRow = $viVewCo->where('u_id', $userId)->where('date <', $today)->countAllResults();

            if (!empty($countRow)) {
                $viVewCoDel = DB()->table('video_view_count');
                $viVewCoDel->where('u_id', $userId);
                $viVewCoDel->where('date <', $today);
                $viVewCoDel->delete();
            }


            $checkVideo = $this->isTheVideoSeen($videoId);
            if ($checkVideo == 0) {

//            $view = '<div class="modal-header">
//                <h4 class="modal-title">' . $query->title . '</h4>
//                <p id="minCount" style="text-align: right;"></p>
//                <button type="button" class="btn btn-success btn-sm" id="closeBtn" onclick="closeModal(' . $query->video_id . ')" style="display: none;">Close</button>
//            </div>';
//            $view .= '<div class="modal-body text-center" >' . $query->vi_url . '</div>';

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


                    $video = DB()->table('video');
                    $data['videoData'] = $video->where('video_id', $videoId)->get()->getRow();

                    $data['sidebar_left'] = view('Theme/'.selected_theme().'/Front/Client_area/sidebar-left', $data);
                    echo view('Theme/'.selected_theme().'/Front/Client_area/header', $data);
                    echo view('Theme/'.selected_theme().'/Front/Client_area/Member/video_view', $data);
                    echo view('Theme/'.selected_theme().'/Front/Client_area/footer', $data);
                }

            } else {
                $view = '<div class="modal-body text-center" >The Video has been already Seen!</div>';
            }
//
//
//        print $view;
        }
    }

    public function view_video_count(){
        $videoId = $this->request->getPost('id');
        $userId = $this->session->user_id_client;

        if (($this->isTheVideoSeen($videoId) == 0) && ($this->totalVideoSeenToday() <= 5)) {
            DB()->transStart();
            $packId = get_id_by_data('package_id', 'users', 'ID', $userId);
            $today = date('Y-m-d');

            //Inserting into video view count table (start)
            $data['date'] = $today;
            $data['video_id'] = $videoId;
            $data['u_id'] = $userId;
            $viVewCo = DB()->table('video_view_count');
            $viVewCo->insert($data);
            //Inserting into video view count table (end)

            //video earning
            $parDayEarn = get_id_by_data('video_watch_earning', 'package', 'package_id', $packId);
            $oldBal = get_id_by_data('balance', 'users', 'ID', $userId);
            $restBal = $oldBal + $parDayEarn;
            $usData = ['balance' => $restBal];
            $user = DB()->table('users');
            $user->where('ID', $userId)->update($usData);


            //commission video
            $comData = ['u_id' => $userId, 'purpose' => 'Video view Earning', 'amount' => $parDayEarn, 'date' => $today];
            $comVideo = DB()->table('comm_video');
            $comVideo->insert($comData);
            DB()->transComplete();
            return 1;
        }else {
            return 0;
        }

    }

    private function totalVideoSeenToday(){
        $userId = $this->session->user_id_client;
        $today = date('Y-m-d');
        $vewVideo = DB()->table('video_view_count');
        $vewVideo->where('u_id',$userId);
        $vewVideo->where('date',$today);
        $count = $vewVideo->countAllResults();

        return $count;
    }

    private function isTheVideoSeen($video_id){
        $userId = $this->session->user_id_client;
        $today = date('Y-m-d');

        $vewVideo = DB()->table('video_view_count');
        $vewVideo->where('u_id',$userId);
        $vewVideo->where('video_id',$video_id);
        $vewVideo->where('date',$today);
        $count = $vewVideo->countAllResults();

        if(!empty($count)){
            return 1;
        }else{
            return 0;
        }

    }


}

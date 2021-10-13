<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Gallery extends BaseController
{
    protected $functionModel;
    protected $globalSettingsModel;

    public function __construct()
    {
        $this->functionModel = new FunctionModel();
        $this->globalSettingsModel = new Global_settings();
    }

    public function index()
    {
        $data['globalSettingsModel'] = $this->globalSettingsModel;

        
        $page = DB()->table('pages');
        $sPage = $page->where('page_id','107')->get();
        $h_page_query = $sPage->getRow();
        $data['title'] = $h_page_query->page_title;
        $data['description'] = $h_page_query->page_description;

        $downloads = DB()->table('downloads');
        $notiCount = $downloads->where('cat_id','5')->countAllResults();
        $notice_list = $downloads->where('cat_id','5')->get();

        if ($notiCount > 0){
            $data['list_notice'] = $notice_list->getResult();
        }else{
            $data['list_notice'] = 'No notice published';
        }

        $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);


        $slider = DB()->table('slider_gallery');
        $sqSlidernumrow = $slider->where('type','slider')->countAllResults();
        $sqSlider = $slider->where('type','slider')->get();

        $slider_list = $sqSlider->getResult();
        if ($sqSlidernumrow > 0)
        {
            $data['list_slider'] = $slider_list;
        }else {
            $data['list_slider'] = 'No Slider Added';
        }
        $data['slider'] = view('front/slider', $data);



        $gallery = DB()->table('slider_gallery');
        $sqgall = $gallery->where('type','gallery')->countAllResults();
        $sqgallery = $gallery->where('type','gallery')->get();

        $gallery_list = $sqgallery->getResult();
        if ($sqgall > 0) {
            $data['list_gallery'] = $gallery_list;
        } else {
            $data['list_gallery'] = 'No Gallery Image Added';
        }
        ;
        $data['page_title'] = 'Gallery';


//        if ($this->m_logged_in == true) {
//            $data['log_url'] = 'member_form/logout_member.html';
//            $data['log_title'] = 'Logout';
//            $data['check_user'] = $this->session->userdata('m_logged_in');
//            $data['ID'] = $this->session->userdata('user_id');
//            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
//            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
//            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
//            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
//            $data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
//            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
//            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
//            $this->load->view('front/client_area/header', $data);
//            $this->load->view('front/page', $data);
//            $this->load->view('front/client_area/footer', $data);
//        } else {
            $data['check_user'] = '';
            $data['log_url'] = 'member_form/login';
            $data['log_title'] = 'Login';
            $data['sidebar_left'] =  view('Front/sidebar-left', $data);
            echo view('Front/header', $data);
            echo view('Front/page', $data);
            echo view('Front/footer', $data);
//        }
    }
}

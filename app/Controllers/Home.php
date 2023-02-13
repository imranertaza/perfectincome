<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Home extends BaseController
{
    protected $functionModel;
    protected $globalSettingsModel;
    public function __construct(){
        $this->functionModel = new FunctionModel();
        $this->globalSettingsModel = new Global_settings();
    }
    public function index()
    {
        
        $data['globalSettingsModel'] = $this->globalSettingsModel;
        $page = DB()->table('pages');
        $sPage = $page->where('page_id','100')->get();
        $h_page_query = $sPage->getRow();
        $data['title'] = $h_page_query->page_title;
        $data['description'] = $h_page_query->page_description;

        $downloads = DB()->table('downloads');
        $sdow = $downloads->where('cat_id','5')->get();
        $last_notice = $sdow->getRow();
        $data['notice_title'] = $last_notice->title;
        $data['notice_description'] = $last_notice->description;
        $data['notice_file'] = $last_notice->file;
        $data['dwn_path'] = base_url()."/uploads/downloads/";

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
        $data['slider'] =  view('Theme/'.selected_theme().'/Front/slider',$data);

        $data['page_title'] = 'home';
        $data['sidebar_left'] = view('Theme/'.selected_theme().'/Front/sidebar-left',$data);

        

        $pack = DB()->table('package');
        $packag = $pack->get();
        $data['package'] = $packag->getResult();
        

//        if ($this->m_logged_in == true) {
//            redirect("member/dashboard/");
//        }else{
            $data['check_user'] = '';
            $data['log_url'] = 'member_form/login';
            $data['log_title'] = 'Login';
            $data['sidebar_left'] = view('Theme/'.selected_theme().'/Front/sidebar-left', $data);
            echo view('Theme/'.selected_theme().'/Front/header', $data);
            echo view('Theme/'.selected_theme().'/Front/page', $data);
            echo view('Theme/'.selected_theme().'/Front/footer', $data);
//        }
    }
}

<?php

namespace App\Controllers;

use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Details extends BaseController
{
    protected $functionModel;
    protected $globalSettingsModel;

    public function __construct()
    {
        $this->functionModel = new FunctionModel();
        $this->globalSettingsModel = new Global_settings();
    }

    public function page($page_title)
    {
        $data['page_title'] = $page_title;
        $data['globalSettingsModel'] = $this->globalSettingsModel;
        $downloads = DB()->table('downloads');

        $notiCount = $downloads->where('cat_id', '5')->countAllResults();
        $notice_list = $downloads->where('cat_id', '5')->get();
        if ($notiCount > 0) {
            $data['list_notice'] = $notice_list->getResult();
        } else {
            $data['list_notice'] = 'No notice published';
        }


        // Notice page
        if ($page_title == 'notice') {
            if ($notiCount > 0) {
                $data['records'] = $notice_list->getResult();
            } else {
                $data['records'] = 'No notice published';
            }
        }


        $data['dwn_path'] = base_url() . "/uploads/downloads/";

        $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

        $slider = DB()->table('slider_gallery');
        $sqSlidernumrow = $slider->where('type', 'slider')->countAllResults();
        $sqSlider = $slider->where('type', 'slider')->get();

        $slider_list = $sqSlider->getResult();
        if ($sqSlidernumrow > 0) {
            $data['list_slider'] = $slider_list;
        } else {
            $data['list_slider'] = 'No Slider Added';
        }
        $data['slider'] = view('Front/slider', $data);

        $data['check_user'] = '';
        $data['log_url'] = 'member_form/login';
        $data['log_title'] = 'Login';
        $data['sidebar_left'] = view('Front/sidebar-left', $data);
        echo view('Front/header', $data);
        echo view('Front/page', $data);
        echo view('Front/footer', $data);
    }
}

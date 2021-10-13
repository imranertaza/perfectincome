<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class details extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('settings_functions_helper');
        if ($this->session->userdata('m_logged_in') == true) {
            $this->m_logged_in = true;
        } else {
            $this->m_logged_in = false;
        }
    }


    public function iteam_details($pro_id)
    {
        $data['pro_id'] = $pro_id;
        $this->load->helper('url');
        $this->load->model('settings/global_settings');
        $this->load->model('functions');
        $this->load->model('front_functions/product/pro_functions');
        $this->load->view('front/header', $data);
        $data['sidebar'] = $this->load->view('front/sidebar', '', true);
        $this->load->view('front/details', $data);
        $this->load->view('front/footer');
    }


    public function products_cat($cat_id)
    {
        $data['cat_id'] = $cat_id;
        $this->load->helper('url');
        $this->load->model('settings/global_settings');
        $this->load->model('functions');
        $this->load->model('front_functions/product/pro_functions');
        $this->load->view('front/header', $data);
        $this->load->view('front/products_cat', $data);
        $this->load->view('front/footer');
    }

    public function page($page_title)
    {
        //$data['page_id'] = $page_id;
        $data['page_title'] = $page_title;
        $this->load->helper('url');
        $this->load->helper('path');
        $this->load->model('settings/global_settings');
        $this->load->model('functions');
        $this->load->library('pagination');

        $notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
        if ($notice_list->num_rows() > 0) {
            $data['list_notice'] = $notice_list->result();
        } else {
            $data['list_notice'] = 'No notice published';
        }


        // Notice page
        if ($page_title == 'notice') {
            $data['base_url'] = base_url() . 'details/page/notice/';
            $data['total_rows'] = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id`")->num_rows();
            $data['per_page'] = 10;
            $data['uri_segment'] = 4;
            $data['num_links'] = 5;
            $get_segment_uri = $this->uri->segment(4);
            $data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;

            $all_dwn_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` LIMIT " . $data['segment'] . ", " . $data['per_page']);
            if ($all_dwn_list->num_rows() > 0) {
                $data['records'] = $all_dwn_list->result();
            } else {
                $data['records'] = 'No Notice Published';
            }
            $this->pagination->initialize($data);
            $data['pagination'] = $this->pagination->create_links();
        }


        //$download_path = "uploads/downloads/";
        //$get_download = set_realpath($download_path);
        $data['dwn_path'] = base_url() . "uploads/downloads/"; //$get_download;

        $data['footer_widget_title'] = $this->functions->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functions->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functions->show_widget('description', 9);

        $slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
        if ($slider_list->num_rows() > 0) {
            $data['list_slider'] = $slider_list->result();
        } else {
            $data['list_slider'] = 'No Slider Added';
        }
        $data['slider'] = $this->load->view('front/slider', $data, true);

        if ($this->m_logged_in == true) {
            $data['log_url'] = 'member_form/logout_member.html';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $this->session->userdata('m_logged_in');
            $data['ID'] = $this->session->userdata('user_id');
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $data['ID']);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
            $this->load->view('front/client_area/header', $data);
            $this->load->view('front/page', $data);
            $this->load->view('front/client_area/footer', $data);
        } else {
            $data['check_user'] = '';
            $data['log_url'] = 'member_form/login.html';
            $data['log_title'] = 'Login';
            $data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
            $this->load->view('front/header', $data);
            $this->load->view('front/page', $data);
            $this->load->view('front/footer', $data);
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

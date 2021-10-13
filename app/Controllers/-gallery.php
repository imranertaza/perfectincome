<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gallery extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}
	}
	
	public function index()
	{
		$this->load->helper('settings_functions_helper');
		$this->load->helper('path');
		$this->load->library('pagination');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');

		$home_page_query = $this->db->query("SELECT * FROM `pages` where `page_id` = '107'");
		$h_page_query = $home_page_query->row();
		$data['title'] = $h_page_query->page_title;
		$data['description'] = $h_page_query->page_description;

		
		$notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($notice_list->num_rows() > 0)
		{
		   $data['list_notice'] = $notice_list->result();
		}else {
			$data['list_notice'] = 'No notice published';	
		}

		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);

		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
			 $data['list_slider'] = 'No Slider Added';	
		}
		$data['slider'] = $this->load->view('front/slider', $data, true);
		

		$data['base_url'] = base_url().'gallery/index/';
		$data['total_rows'] = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'gallery' ORDER BY `sl_id` ASC")->num_rows();
		$data['per_page'] = 16; 
		$data['uri_segment'] = 3;
		$data['num_links'] = 5;
		$get_segment_uri = $this->uri->segment(3);
		$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
		$gallery_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'gallery' ORDER BY `sl_id` ASC LIMIT ".$data['segment'].", ".$data['per_page']);
		$this->pagination->initialize($data);
		$data['pagination'] = $this->pagination->create_links();
		
		//$gallery_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'gallery' ORDER BY `sl_id` DESC");
		if ($gallery_list->num_rows() > 0)
		{
		   $data['list_gallery'] = $gallery_list->result();
		}else {
			 $data['list_gallery'] = 'No Gallery Image Added';
		}
		//$data['gallery'] = $this->load->view('front/slider', $data, true);
		$data['page_title'] = 'Gallery';
		
		
		if ($this->m_logged_in == true) {
			$data['log_url'] = 'member_form/logout_member.html';
			$data['log_title'] = 'Logout';
			$data['check_user'] = $this->session->userdata('m_logged_in');
			$data['ID'] = $this->session->userdata('user_id');
			$data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
			$data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
			$data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
			$data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
			$data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
			$data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/page', $data);
			$this->load->view('front/client_area/footer', $data);
		}else{
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

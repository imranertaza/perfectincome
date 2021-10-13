<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('users/user_login');
		$this->load->helper('settings_functions_helper');
		
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}
	}
	

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('student_functions_helper');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');
		$this->load->library('pagination');
		
		$notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($notice_list->num_rows() > 0)
		{
		   $data['list_notice'] = $notice_list->result();
		}else {
			$data['list_notice'] = 'No notice published';	
		}

		$data['base_url'] = base_url().'product/index/';
		$data['total_rows'] = $this->db->query("SELECT * FROM `products` ORDER BY `pro_id` DESC")->num_rows();
		$data['per_page'] = 10; 
		$data['uri_segment'] = 3;
		$data['num_links'] = 5;
		$get_segment_uri = $this->uri->segment(3);
		$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
		$student_list = $this->db->query("SELECT * FROM `products` ORDER BY `pro_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
		
		if (isset($_POST['filter_tec'])) {
			$std_name = $_POST['name'];
			if (!empty($std_name)) { $search_name = "`name` LIKE '%$std_name%'"; }else { $search_name = "1=1"; }
			
			
			$data['base_url'] = base_url().'product/index/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `products` WHERE $search_name ORDER BY `pro_id`")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 3;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(3);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$student_list = $this->db->query("SELECT * FROM `products` WHERE $search_name ORDER BY `pro_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
		}
		
		if ($student_list->num_rows() > 0)
		{
		   $data['list_teacher'] = $student_list->result();
		}else {
			 $data['list_teacher'] = 'No Product Found';	
		}
		
		$this->pagination->initialize($data);
		$data['pagination'] = $this->pagination->create_links();
		
		

		$data['dwn_path'] = base_url()."uploads/downloads/";
		
		$data['timthumb'] = "assets/timthumb.php";
		$data['pro_path'] = "uploads/pro_image/";
		$data['web_page_title'] = "Product List";

		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);
		$data['page_title'] = 'Product List';
		
		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
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
			$data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
			$data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/product', $data);
			$this->load->view('front/client_area/footer', $data);
		}else{
			$data['check_user'] = '';
			$data['log_url'] = 'member_form/login.html';
			$data['log_title'] = 'Login';
			$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
			$this->load->view('front/header', $data);
			$this->load->view('front/product', $data);
			$this->load->view('front/footer', $data);
		}
	}
	
	
	
	public function view($pro_id)
	{
		$data['pro_id'] = $pro_id;
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('settings_functions_helper');
		$this->load->helper('product_helper');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');
		
		$notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($notice_list->num_rows() > 0)
		{
		   $data['list_notice'] = $notice_list->result();
		}else {
			$data['list_notice'] = 'No notice published';	
		}
		

		$teacher_list = $this->db->query("SELECT * FROM `products` WHERE `pro_id` = '$pro_id'");
		if ($teacher_list->num_rows() > 0)
		{
		   $data['list_teacher'] = $teacher_list->row();
		   $data['web_page_title'] = $data['list_teacher']->name;
		}else {
			 $data['list_teacher'] = 'No Product Found';	
		}
		
		
		//$download_path = "uploads/downloads/";
		//$get_download = set_realpath($download_path);
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		
		
		$data['timthumb'] = "assets/timthumb.php";
		$data['pro_path'] = "uploads/pro_image/";
		

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
			$this->load->view('front/product_detail', $data);
			$this->load->view('front/client_area/footer', $data);
		}else{
			$data['check_user'] = '';
			$data['log_url'] = 'member_form/login.html';
			$data['log_title'] = 'Login';
			$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
			$this->load->view('front/header', $data);
			$this->load->view('front/product_detail', $data);
			$this->load->view('front/footer', $data);
		}
		
	}
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

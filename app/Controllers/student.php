<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('users/user_login');
		
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
		
		
		$internal_result_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (10) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($internal_result_list->num_rows() > 0)
		{
		   $data['list_result_internal'] = $internal_result_list->result();
		}else {
			 $data['list_result_internal'] = 'No Internal Result Published';	
		}
		
		
		$public_result_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (9) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($public_result_list->num_rows() > 0)
		{
		   $data['list_result_public'] = $public_result_list->result();
		}else {
			 $data['list_result_public'] = 'No Public Result Published';	
		}
		
		$circular_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (6) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($circular_list->num_rows() > 0)
		{
		   $data['list_carcular'] = $circular_list->result();
		}else {
			 $data['list_carcular'] = 'No Circular Published';	
		}
		
		
		$routine_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (7) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($routine_list->num_rows() > 0)
		{
		   $data['list_routine'] = $routine_list->result();
		}else {
			 $data['list_routine'] = 'No Routine Published';	
		}
		
		$holiday_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (8) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($holiday_list->num_rows() > 0)
		{
		   $data['list_holiday'] = $holiday_list->result();
		}else {
			 $data['list_holiday'] = 'No Holiday Notice Published';	
		}
		
		
		
		$data['base_url'] = base_url().'student/index/';
		$data['total_rows'] = $this->db->query("SELECT * FROM `students` ORDER BY `std_id`")->num_rows();
		$data['per_page'] = 10; 
		$data['uri_segment'] = 3;
		$data['num_links'] = 5;
		$get_segment_uri = $this->uri->segment(3);
		$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
		$student_list = $this->db->query("SELECT * FROM `students` ORDER BY `std_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
		
		if (isset($_POST['filter_std'])) {
			$std_name = $_POST['name'];
			$std_class = $_POST['class'];
			$std_group = $_POST['group'];
			if (!empty($std_name)) { $search_name = "`name` LIKE '%$std_name%'"; }else { $search_name = "1=1"; }
			if (!empty($std_class)) { $search_class = "`class_id` = '$std_class'"; }else { $search_class = "1=1"; }
			if (!empty($std_group)) { $search_group = "`group_id` = '$std_group'"; }else { $search_group = "1=1"; }
			
			$data['base_url'] = base_url().'student/index/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `students` WHERE $search_name AND $search_class AND $search_group ORDER BY `std_id`")->num_rows();
			$data['per_page'] = 10;
			$data['uri_segment'] = 3;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(3);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$student_list = $this->db->query("SELECT * FROM `students` WHERE $search_name AND $search_class AND $search_group ORDER BY `std_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
		}
		
		if ($student_list->num_rows() > 0)
		{
		   $data['list_student'] = $student_list->result();
		}else {
			 $data['list_student'] = '<p class="alert alert-info not_fount">No Student Found</p>';	
		}
		
		$this->pagination->initialize($data);
		$data['pagination'] = $this->pagination->create_links();
		
		
		//$download_path = "uploads/downloads/";
		//$get_download = set_realpath($download_path);
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		
		$data['timthumb'] = "assets/timthumb.php";
		$data['std_path'] = "uploads/std_image/";
		$data['web_page_title'] = "Student List";
		
		$data['head_teacher_name'] = $this->functions->show_widget('title', 10);
		$data['head_teacher_comment'] = $this->functions->show_widget('description', 10);
		$data['head_teacher_photo'] = $this->functions->show_widget_img(10, 150, 200);
		
		$data['chairman_name'] = $this->functions->show_widget('title', 5);
		$data['chairman_comment'] = $this->functions->show_widget('description', 5);
		$data['chairman_photo'] = $this->functions->show_widget_img(5, 150, 200);
		
		$data['important_links'] = $this->functions->show_widget('description', 6);
		
		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);
		
		
		if ($this->m_logged_in == true) {
		$data['log_url'] = 'member_form/logout_member.html';
		$data['log_title'] = 'Logout';
		}else {
		$data['log_url'] = 'member_form/login.html';
		$data['log_title'] = 'Login';
		}
		$data['check_user'] = $this->session->userdata('m_logged_in');
		
		
		$data['check_user'] = '';
		if ($this->m_logged_in == true) {
			$data['check_user'] = $this->session->userdata('m_logged_in');
			$data['u_name'] = $this->session->userdata('u_name');
			$data['age'] = $this->session->userdata('age');
			if ($data['check_user'] == 1) {
			$data['u_id'] = $this->session->userdata('tec_id');
			}
			if ($data['check_user'] == 2) {
			$data['u_id'] = $this->session->userdata('std_id');
			}
		}
		
		
		
		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
			 $data['list_slider'] = 'No Slider Added';	
		}
		$data['slider'] = $this->load->view('front/slider', $data, true);
		
		
		
		$this->load->view('front/header', $data);
		$this->load->view('front/sidebar-left', $data);
		$this->load->view('front/student', $data);
		$this->load->view('front/sidebar-right', $data);
		$this->load->view('front/footer', $data);
	}
	
	
	
	public function view($std_id)
	{
		$data['std_id'] = $std_id;
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('settings_functions_helper');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');
				
		
		$notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($notice_list->num_rows() > 0)
		{
		   $data['list_notice'] = $notice_list->result();
		}else {
			$data['list_notice'] = 'No notice published';	
		}
		
		
		$internal_result_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (10) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($internal_result_list->num_rows() > 0)
		{
		   $data['list_result_internal'] = $internal_result_list->result();
		}else {
			 $data['list_result_internal'] = 'No Internal Result Published';	
		}
		
		
		$public_result_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (9) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($public_result_list->num_rows() > 0)
		{
		   $data['list_result_public'] = $public_result_list->result();
		}else {
			 $data['list_result_public'] = 'No Public Result Published';	
		}
		
		$circular_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (6) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($circular_list->num_rows() > 0)
		{
		   $data['list_carcular'] = $circular_list->result();
		}else {
			 $data['list_carcular'] = 'No Circular Published';	
		}
		
		
		$routine_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (7) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($routine_list->num_rows() > 0)
		{
		   $data['list_routine'] = $routine_list->result();
		}else {
			 $data['list_routine'] = 'No Routine Published';	
		}
		
		$holiday_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (8) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($holiday_list->num_rows() > 0)
		{
		   $data['list_holiday'] = $holiday_list->result();
		}else {
			 $data['list_holiday'] = 'No Holiday Notice Published';	
		}
		

		$student_list = $this->db->query("SELECT * FROM `students` WHERE `std_id` = '$std_id'");
		if ($student_list->num_rows() > 0)
		{
		   $data['list_student'] = $student_list->row();
		   $data['web_page_title'] = $data['list_student']->name;
		}else {
			 $data['list_student'] = 'No Student Found';	
		}
		
		
		//$download_path = "uploads/downloads/";
		//$get_download = set_realpath($download_path);
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		
		
		$data['timthumb'] = "assets/timthumb.php";
		$data['std_path'] = "uploads/std_image/";
		
		
		$data['head_teacher_name'] = $this->functions->show_widget('title', 10);
		$data['head_teacher_comment'] = $this->functions->show_widget('description', 10);
		$data['head_teacher_photo'] = $this->functions->show_widget_img(10, 150, 200);
		
		$data['chairman_name'] = $this->functions->show_widget('title', 5);
		$data['chairman_comment'] = $this->functions->show_widget('description', 5);
		$data['chairman_photo'] = $this->functions->show_widget_img(5, 150, 200);
		
		$data['important_links'] = $this->functions->show_widget('description', 6);
		
		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);
		
		$data['check_user'] = $this->session->userdata('m_logged_in');
		
		if ($this->m_logged_in == true) {
		$data['log_url'] = 'member_form/logout_member.html';
		$data['log_title'] = 'Logout';
		}else {
		$data['log_url'] = 'member_form/login.html';
		$data['log_title'] = 'Login';
		}
		
		
		$data['check_user'] = '';
		if ($this->m_logged_in == true) {
			$data['check_user'] = $this->session->userdata('m_logged_in');
			$data['u_name'] = $this->session->userdata('u_name');
			$data['age'] = $this->session->userdata('age');
			if ($data['check_user'] == 1) {
			$data['u_id'] = $this->session->userdata('tec_id');
			}
			if ($data['check_user'] == 2) {
			$data['u_id'] = $this->session->userdata('std_id');
			}
		}
		
		
		
		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
			 $data['list_slider'] = 'No Slider Added';	
		}
		$data['slider'] = $this->load->view('front/slider', $data, true);
		
		
		$this->load->view('front/header', $data);
		$this->load->view('front/sidebar-left', $data);
		$this->load->view('front/student_detail', $data);
		$this->load->view('front/sidebar-right', $data);
		$this->load->view('front/footer', $data);
		
	}
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

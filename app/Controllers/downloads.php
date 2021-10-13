<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class downloads extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('settings_functions_helper');
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}
	}
	
	
	public function details($dwn_id)
	{
		$data['dwn_id'] = $dwn_id;
		$this->load->helper('url');
		$this->load->helper('path');
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
		
		
		$data['dwn_path'] = base_url()."uploads/downloads/";
		
		
		$data['head_teacher_name'] = $this->functions->show_widget('title', 5);
		$data['head_teacher_comment'] = $this->functions->show_widget('description', 5);
		$data['head_teacher_photo'] = $this->functions->show_widget_img(5, 150, 200);
		
		$data['chairman_name'] = $this->functions->show_widget('title', 5);
		$data['chairman_comment'] = $this->functions->show_widget('description', 5);
		$data['chairman_photo'] = $this->functions->show_widget_img(5, 150, 200);
		
		$data['important_links'] = $this->functions->show_widget('description', 6);
		
		
		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);
		
		
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
		

		
		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` DESC LIMIT 0, 5");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
			 $data['list_slider'] = 'No Slider Added';	
		}
		$data['slider'] = $this->load->view('front/slider', $data, true);
		
		
		
		$data['check_user'] = $this->session->userdata('m_logged_in');
		
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
		}else {
		$data['log_url'] = 'member_form/login.html';
		$data['log_title'] = 'Login';
		}
		
		
		$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
		//$data['sidebar_right'] = $this->load->view('front/sidebar-right', $data, true);
		
		
		$dwn_query = $this->db->query("SELECT * FROM `downloads` WHERE `dwn_id` = '$dwn_id'");
		if ($dwn_query->num_rows() > 0)
		{
		   foreach ($dwn_query->result() as $row)
		   {
			  $data['title'] = $row->title;
			  $data['description'] = $row->description;
			  $data['file'] = $row->file;
		   }
		}else {
			$data['not_found'] = 'Sorry this is not a existance page!';
		}
		
		$this->load->view('front/header', $data);
		$this->load->view('front/single', $data);
		$this->load->view('front/footer', $data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

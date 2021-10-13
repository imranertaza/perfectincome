<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dealer_search extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('settings_functions_helper');
		$this->load->database();
		$this->load->model('functions');
		$this->load->library('form_validation');
		$this->load->model('users/user_login');
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}
		
		$this->load->helper('settings_functions_helper');
		$this->load->helper('path');
		$this->load->library('pagination');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');
		
	}

	public function index($user_id=0)
	{
		$this->load->helper('student_functions_helper');
		
		$data['dwn_path'] = base_url()."uploads/downloads/";
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
		
		$data['page_title'] = 'home';
		$data['slider'] = '';
		
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
			$data['user_id'] = $user_id;
			
			
			if(isset($_POST['search_agent'])) {
				$division = isset($_POST['division']) ? $_POST['division'] : 0;
				$district = isset($_POST['district']) ? $_POST['district'] : 0;
				$upozila = isset($_POST['upozila']) ? $_POST['upozila'] : 0;
				$union = isset($_POST['union']) ? $_POST['union'] : 0;
				
				if (!empty($division)) { $division_src = "`division` = '$division'"; }else { $division_src = "1=1"; }
				if (!empty($district)) { $district_src = "`district` = '$district'"; }else { $district_src = "1=1"; }
				if (!empty($upozila)) { $upozila_src = "`upozila` = '$upozila'"; }else { $upozila_src = "1=1"; }
				if (!empty($union)) { $union_src = "`union` = '$union'"; }else { $union_src = "1=1"; }
				
				
			$data['base_url'] = base_url().'member/dealer_search/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `users`,`user_roles` WHERE `users`.`ID`= `user_roles`.`userID` AND `user_roles`.`roleID` = '4' AND $division_src AND $district_src AND $upozila_src AND $union_src ORDER BY `ID` DESC")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 4;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(4);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			
			$agent_list = $this->db->query("SELECT * FROM `users`,`user_roles` WHERE `users`.`ID`= `user_roles`.`userID` AND `user_roles`.`roleID` = '4' AND $division_src AND $district_src AND $upozila_src AND $union_src ORDER BY `ID` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $agent_list->result();
				
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			}
			
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/member/dealer_search', $data);
			$this->load->view('front/client_area/footer', $data);
		}else{
			$data['check_user'] = '';
			$data['log_url'] = 'member_form/login.html';
			$data['log_title'] = 'Login';
			$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
			$this->load->view('front/header', $data);
			$this->load->view('front/member_form', $data);
			$this->load->view('front/footer', $data);
		}
		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
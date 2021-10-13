<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdraw extends CI_Controller {
	
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

	public function spon($user_id=0)
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
			
			$data['total_amount'] = $this->db->query("SELECT SUM(amount) FROM `comm_spot` WHERE `u_id` = ".$data['ID'])->result_array();
			
			if (isset($_POST['withdraw'])) {
			$amount =$_POST['amount'];
			$withdraw_charge =$_POST['withdraw_charge'];
			$payable_amount =$_POST['payable_amount'];
			$agent_name =$_POST['agent_id'];
			$remarks =$_POST['remarks'];
			$egent_id = get_ID_by_username($agent_name);
			$from = $data['ID'];
			
			$int_data = array(
			'amount' => $amount,
			'charge' => $withdraw_charge,
			'payable' => $payable_amount,
			'to' => $egent_id,
			'form' => $from,
			'title' => $remarks
			);
			
			$this->db->insert('withdrow_req_sponsor', $int_data); 
			}
			
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/member/withdraw', $data);
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
	
	
	public function mat($user_id=0)
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
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			
			
			
			
			
			$data['total_amount'] = $this->db->query("SELECT SUM(amount) FROM `comm_matching` WHERE `u_id` = ".$data['ID'])->result_array();
			
			if (isset($_POST['withdraw'])) {
			$amount =$_POST['amount'];
			$withdraw_charge =$_POST['withdraw_charge'];
			$payable_amount =$_POST['payable_amount'];
			$agent_name =$_POST['agent_id'];
			$remarks =$_POST['remarks'];
			$egent_id = get_ID_by_username($agent_name);
			$from = $data['ID'];
			
			$int_data = array(
			'amount' => $amount,
			'charge' => $withdraw_charge,
			'payable' => $payable_amount,
			'to' => $egent_id,
			'form' => $from,
			'title' => $remarks
			);
			
			$this->db->insert('withdrow_req_match', $int_data); 
			}
			
			
			
			$this->load->view('front/client_area/member/withdraw', $data);
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
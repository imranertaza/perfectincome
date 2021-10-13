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
	
	public function index()
	{
		
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		
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
			$data['ID'] = $this->session->userdata('ID');
			$data['u_name'] = $this->session->userdata('u_name');
			$data['f_name'] = $this->session->userdata('f_name');
			$data['l_name'] = $this->session->userdata('l_name');
			$data['balance'] = $this->session->userdata('balance');
			$data['Point'] = $this->session->userdata('Point');
			$data['role'] = $this->session->userdata('role');
			if ($data['role'] == 4) {
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$products = $this->db->query("SELECT * FROM `products`");
			$data['pro_query'] = $products->result();
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/agent/withdraw', $data);
			$this->load->view('front/client_area/footer', $data);
			}
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
	
	
	
	public function my_tree($user_id=0)
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
			$data['ID'] = $this->session->userdata('ID');
			$data['u_name'] = $this->session->userdata('u_name');
			$data['f_name'] = $this->session->userdata('f_name');
			$data['l_name'] = $this->session->userdata('l_name');
			$data['balance'] = $this->session->userdata('balance');
			$data['Point'] = $this->session->userdata('Point');
			$data['role'] = $this->session->userdata('role');
			$data['user_id'] = $user_id;
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/my_tree', $data);
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
	



	public function login() {

		$home_page_query = $this->db->query("SELECT * FROM `pages` where `page_id` = '100'");
		$h_page_query = $home_page_query->row();
		$data['title'] = $h_page_query->page_title;
		$data['description'] = $h_page_query->page_description;
		$data['check_user'] = $this->session->userdata('m_logged_in');
		$data['slider'] = '';
		$login = '';
		

		$latest_notice = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC");
		$last_notice = $latest_notice->row();
		$data['notice_title'] = $last_notice->title;
		$data['notice_description'] = $last_notice->description;
		$data['notice_file'] = $last_notice->file;
		
		
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		
		
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
		

		if (isset($_POST['login'])) {
		$this->form_validation->set_rules('username', 'Usernmae', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[10]|xss_clean');
			
			if ($this->form_validation->run() == TRUE) {
				$login = $this->user_login->login_member();
			}
		}
		
		if (($this->m_logged_in == true) || ($login)) {
			$data['check_user'] = $this->session->userdata('m_logged_in');
			$data['ID'] = $this->session->userdata('ID');
			$data['u_name'] = $this->session->userdata('u_name');
			$data['f_name'] = $this->session->userdata('f_name');
			$data['l_name'] = $this->session->userdata('l_name');
			$data['balance'] = $this->session->userdata('balance');
			$data['Point'] = $this->session->userdata('Point');
			$data['role'] = $this->session->userdata('role');
			$data['page_title'] = 'home';
			$data['log_url'] = 'member_form/logout_member.html';
			$data['log_title'] = 'Logout';
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/member_form', $data);
			$this->load->view('front/client_area/footer', $data);
		}else {
			$data['log_url'] = 'member_form/login.html';
			$data['log_title'] = 'Login';
			$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
			$this->load->view('front/header', $data);
			$this->load->view('front/member_form', $data);
			$this->load->view('front/footer', $data);	
		}	
		
	}
	
	
	
	
	
	public function register() {
		$this->load->helper('student_functions_helper');
		
		
		
		$data['msg'] = '';
		// Registration Code
		if (isset($_POST['add_user'])) {
				$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('addr', 'Address', 'xss_clean|encode_php_tags');
				$this->form_validation->set_rules('phone', 'Phone', 'xss_clean|encode_php_tags|is_natural');
				$this->form_validation->set_rules('nid', 'National ID Card', 'xss_clean|encode_php_tags');
				$this->form_validation->set_rules('ref_id', 'Referal ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('spon_id', 'Sponsor ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('p_id', 'Placement ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('position', 'Side', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]');
				$this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|max_length[20]|is_unique[users.username]');
				$this->form_validation->set_rules('pass', 'Password', 'required|matches[con_pass]|min_length[10]|max_length[20]');
				$this->form_validation->set_rules('con_pass', 'Password Confirmation', 'required||min_length[10]|max_length[20]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('per_addr', 'Permanent Address', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('father', 'Father Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('mother', 'Mother Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('religion', 'Religion', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('sex', 'Gender', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('b_group', 'Blood Group', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('division', 'Division', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('district', 'District', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('upozila', 'Upozila', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('union', 'Union/Ward', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('post_code', 'Post Code', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('non', 'Nominee Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('relation', 'Relation', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('nodob', 'Nominee date of birth', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('banks', 'Bank name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('account_no', 'Bank account number', 'required|xss_clean|encode_php_tags');
				
				
				if ($this->form_validation->run() == TRUE)
				{
					
				
				//Image upload
				$photo_name = 'profile_'.time().'.jpg';
				$config['upload_path'] 		= 'uploads/user_image/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['file_name'] 		= $photo_name;
				$config['max_size']     	= '100';
				$config['image_width'] 		= '1024';
				$config['image_height'] 	= '768';
				$config['is_image'] 		= 1;
				$config['max_size']			= 0;
				$this->load->library('upload', $config);
				$this->upload->do_upload('photo');
					
				
				// Insert into user
				$data_personal = array(
						'email' => $_POST['email'],
						'username' => $_POST['uname'],
						'password' => md5($_POST['pass']),
						'f_name' => $_POST['fname'],
						'l_name' => $_POST['lname'],
						'address1' => $_POST['addr'],
						'phn_no' => $_POST['phone'],
						'nid' => $_POST['nid'],
						'balance' => '0',
						'Point' => '0',
						//'type' => $_POST['u_type'],
						'status' => 'Inactive',
						'address2' => $_POST['per_addr'],
						'father' => $_POST['father'],
						'mother' => $_POST['mother'],
						'religion' => $_POST['religion'],
						'sex' => $_POST['sex'],
						'blood' => $_POST['b_group'],
						'division' => $_POST['division'],
						'district' => $_POST['district'],
						'upozila' => $_POST['upozila'],
						'union' => $_POST['union'],
						'post' => $_POST['post_code'],
						'photo' => $photo_name,
						'nominee' => $_POST['non'],
						'relationship' => $_POST['relation'],
						'nom_dob' => $_POST['nodob'],
						'bank_name' => $_POST['banks'],
						'account_no' => $_POST['account_no']
				);
				$this->db->insert('users', $data_personal);
				
				
				// Insert into Tree
				$insert_userid = mysql_insert_id();
				$current_time = date('Y-M-D h:m:s');
				$data_role = array(
						'userID' => $insert_userid,
						'roleID' => 6,
						'addDate' => $current_time
				);
				$this->db->insert('user_roles', $data_role);
				
				
				// Insert into Tree
				$pid = get_ID_by_username($_POST['p_id']);
				$ref_id = get_ID_by_username($_POST['ref_id']);
				$spon_id = get_ID_by_username($_POST['spon_id']);
				$data_tree = array(
						'u_id' => $insert_userid,
						'pr_id' => $pid,
						'ref_id' => $ref_id,
						'spon_id' => $spon_id
				);
				$this->db->insert('Tree', $data_tree);
				
				// Update Tree for left and right
				if ($_POST['position'] == 1) {
					$data_left_right = array(
							'l_t' => $insert_userid
					);
				}
				if ($_POST['position'] == 2) {
					$data_left_right = array(
							'r_t' => $insert_userid
					);
				}
				$this->db->where('u_id', $pid);
				$this->db->update('Tree', $data_left_right);
				
					$data['msg'] = '<p class="success">Successfully Resistered.</p>';
				
				}else {
					$data['msg'] = '<p class="error">Sorry Something Wrong. Please try again.</p>';
				}
				
			}
		
		
		
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
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
			$data['ID'] = $this->session->userdata('ID');
			$data['u_name'] = $this->session->userdata('u_name');
			$data['f_name'] = $this->session->userdata('f_name');
			$data['l_name'] = $this->session->userdata('l_name');
			$data['balance'] = $this->session->userdata('balance');
			$data['Point'] = $this->session->userdata('Point');
			$data['role'] = $this->session->userdata('role');
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/register', $data);
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
	
	
	


	function logout_member() {
		
		
		$home_page_query = $this->db->query("SELECT * FROM `pages` where `page_id` = '100'");
		$h_page_query = $home_page_query->row();
		$data['title'] = $h_page_query->page_title;
		$data['description'] = $h_page_query->page_description;
		$data['check_user'] = false;
		$data['slider'] = '';
		
		$notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($notice_list->num_rows() > 0)
		{
		   $data['list_notice'] = $notice_list->result();
		}else {
			$data['list_notice'] = 'No notice published';	
		}
		
		$data['page_title'] = 'home';
		$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
		
		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);
		
		$data['log_url'] = 'member_form/login.html';
		$data['log_title'] = 'Login';
		
		
		$this->session->unset_userdata('m_logged_in');
		$this->session->sess_destroy();
		$this->load->view('front/header', $data);
		$this->load->view('front/member_form', $data);
		$this->load->view('front/footer', $data);
	}
	
}

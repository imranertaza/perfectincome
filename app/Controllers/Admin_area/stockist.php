<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class stockist extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('users/user_login');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		if ($this->session->userdata('logged_in') == true) {
			$this->login_status = true;
		}else {
			$this->login_status = false;
		}
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function listi()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->helper('student_functions_helper');
			if ($this->functions->hasPermission('page_list') == true) {
			$this->load->model('student/student_function');
			$this->load->library('pagination');
			$data['title'] = 'Stockist';
			$data['search'] = 'listi';
			
			$username = isset($_POST['username']) ? $_POST['username'] : 0;
			$phone = isset($_POST['phone']) ? $_POST['phone'] : 0;
			if (!empty($username)) { $name_src = "`username` LIKE '%$username%'"; }else { $name_src = "1=1"; }
			if (!empty($phone)) { $phone_src = "`phn_no` LIKE '%$phone%'"; }else { $phone_src = "1=1"; }
			
			$data['base_url'] = base_url().'admin_area/stockist/listi/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `users`,`user_roles` WHERE `users`.`ID`= `user_roles`.`userID` AND `user_roles`.`roleID` = '5' AND $name_src AND $phone_src ORDER BY `ID` DESC")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 4;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(4);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$all_student = $this->db->query("SELECT * FROM `users`,`user_roles` WHERE `users`.`ID`= `user_roles`.`userID` AND `user_roles`.`roleID` = '5' AND $name_src AND $phone_src ORDER BY `ID` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $all_student->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			$this->load->view('admin/stockist/listi', $data);
			
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	public function add()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_user') == true) {
			$this->load->model('functions');
			$this->load->model('users/user_model');
			$this->load->helper('settings_functions_helper');
			$data['msg'] = '';
			
			if (isset($_POST['add_user'])) {
				//for validation
				$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('addr', 'Address', 'xss_clean|encode_php_tags');
				$this->form_validation->set_rules('phone', 'Phone', 'xss_clean|encode_php_tags|is_natural');
				$this->form_validation->set_rules('nid', 'National ID Card', 'xss_clean|encode_php_tags');
				//$this->form_validation->set_rules('u_type', 'User Type', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]');
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
				
				
				// Insert into user_roles
				$insert_userid = mysql_insert_id();
				$current_time = date('Y-M-D h:m:s');
				$data_role = array(
						'userID' => $insert_userid,
						'roleID' => 5,
						'addDate' => $current_time
				);
				$this->db->insert('user_roles', $data_role);
				
				
					$data['msg'] = '<p class="success">Successfully Resistered.</p>';
				
				}else {
					$data['msg'] = '<p class="error">Sorry Something Wrong. Please try again.</p>';
				}
				
			}
			
			
			$this->load->view('admin/stockist/add', $data);
			
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
	}
	
	
	public function edit($user_id)
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_user') == true) {
			$this->load->model('functions');
			$this->load->model('users/user_model');
			$this->load->helper('settings_functions_helper');
			$data['msg'] = '';
			
			if (isset($_POST['add_user'])) {
				//for validation
				$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('addr', 'Address', 'xss_clean|encode_php_tags');
				$this->form_validation->set_rules('phone', 'Phone', 'xss_clean|encode_php_tags|is_natural');
				$this->form_validation->set_rules('nid', 'National ID Card', 'xss_clean|encode_php_tags');
				//$this->form_validation->set_rules('u_type', 'User Type', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]');
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
				
				
				// Insert into user_roles
				$insert_userid = mysql_insert_id();
				$current_time = date('Y-M-D h:m:s');
				$data_role = array(
						'userID' => $insert_userid,
						'roleID' => 5,
						'addDate' => $current_time
				);
				$this->db->insert('user_roles', $data_role);
				
				
					$data['msg'] = '<p class="success">Successfully Resistered.</p>';
				
				}else {
					$data['msg'] = '<p class="error">Sorry Something Wrong. Please try again.</p>';
				}
				
			}
			
			
			$this->load->view('admin/stockist/edit', $data);
			
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
	}
	
	
	
	public function view($std_id)
	{
		$data['std_id'] = $std_id;
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_page') == true) {
			
			$this->load->helper('student_functions_helper');
			$this->load->model('student/student_function');
			$this->load->model('front_functions/student/std_functions');
			
			$selete_page = $this->db->get_where('users', array('ID' => $std_id));
			$data['row'] = $selete_page->row_array();
			$data['pro_image'] = $this->student_function->view_student_image($std_id, 150, 150);
			
			$this->load->view('admin/stockist/view', $data);
			
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
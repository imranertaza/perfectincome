<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	
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
	public function users_list()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('user_list') == true) {
			$this->load->model('functions');
			$this->load->model('users/user_model');
			$this->load->view('admin/users/users_list');
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
	
	public function add_user()
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
				$this->form_validation->set_rules('ref_id', 'Referal ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('spon_id', 'Sponsor ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('p_id', 'Placement ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('position', 'Side', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]');
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
						'roleID' => $_POST['role'],
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
			
			
			$this->load->view('admin/users/add_user', $data);
			
			
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
	
	
	public function edit_user($user_id)
	{
		$this->load->helper('settings_functions_helper');
		$data['row'] = $this->db->query("SELECT * FROM `users` WHERE `ID` = '$user_id'")->row();
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_user') == true) {
			$this->load->model('functions');
			$this->load->model('users/user_model');
			$this->load->view('admin/users/edit_user', $data);
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
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
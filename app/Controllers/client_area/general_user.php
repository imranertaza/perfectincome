<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class general_user extends CI_Controller {

	public function signup()
	{
		
			$this->load->view('front/header');
			//$this->load->model('functions');
			//$this->load->model('users/user_model');
			//$this->load->helper('settings_functions_helper');
			
			
			/*if (isset($_POST['add_user'])) {
				
				//for validation
				$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('addr', 'Address', 'xss_clean|encode_php_tags');
				$this->form_validation->set_rules('phone', 'Phone', 'xss_clean|encode_php_tags|is_natural');
				$this->form_validation->set_rules('nid', 'National ID Card', 'xss_clean|encode_php_tags');
				$this->form_validation->set_rules('ref_id', 'Referal ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('p_id', 'Placement ID', 'required|xss_clean|encode_php_tags');
				$this->form_validation->set_rules('position', 'Side', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]');
				$this->form_validation->set_rules('u_type', 'User Type', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]');
				$this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|max_length[20]|is_unique[users.username]');
				$this->form_validation->set_rules('pass', 'Password', 'required|matches[passconf]|min_length[10]|max_length[20]');
				$this->form_validation->set_rules('con_pass', 'Password Confirmation', 'required||min_length[10]|max_length[20]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
				
				
				if ($this->form_validation->run() == TRUE)
				{
				// Insert into user
				$data_personal = array(
						'email' => $_POST['email'],
						'username' => $_POST['uname'],
						'password' => $_POST['pass'],
						'f_name' => $_POST['fname'],
						'l_name' => $_POST['lname'],
						'address1' => $_POST['addr'],
						'phn_no' => $_POST['phone'],
						'nid' => $_POST['nid'],
						'balance' => '0',
						'Point' => '0',
						'type' => $_POST['u_type'],
						'status' => 'Inactive' 	
				);
				$this->db->insert('users', $data_personal);
				
				
				// Insert into Tree
				$insert_userid = mysql_insert_id();
				$current_time = date('Y-M-D h:m:s');
				$data_role = array(
						'userID' => $insert_userid,
						'roleID' => $_POST['role'],
						'addDate' => $current_time
				);
				$this->db->insert('user_roles', $data_role);
				
				
				// Insert into Tree
				$data_tree = array(
						'u_id' => $insert_userid,
						'pr_id' => $_POST['p_id'],
						'ref_id' => $_POST['ref_id']
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
				$this->db->where('u_id', $_POST['p_id']);
				$this->db->update('Tree', $data_left_right);
				
				}
				
			}*/
			$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
			$this->load->view('front/signup', $data);
			$this->load->view('front/footer', $data);
		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
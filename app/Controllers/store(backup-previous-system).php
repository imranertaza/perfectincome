<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class store extends CI_Controller {

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
			$this->load->library('cart');
			$data['msg'] = '';
			
			$data['success'] = false;
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
						
					
					//Image upload into temp file
					$photo_name = 'profile_'.time().'.jpg';
					$config['upload_path'] 		= 'uploads/temp/';
					$config['allowed_types'] 	= 'gif|jpg|png';
					$config['file_name'] 		= $photo_name;
					$config['max_size']     	= '100';
					$config['image_width'] 		= '1024';
					$config['image_height'] 	= '768';
					$config['is_image'] 		= 1;
					$config['max_size']			= 0;
					$this->session->set_userdata("config", $config);
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
					$this->session->set_userdata("personal_data", $data_personal);
					//$this->db->insert('users', $data_personal);
					
					
					// Insert into user_role
					$current_time = date('Y-M-D h:m:s');
					$data_role = array(
							'userID' => 0,
							'roleID' => 6,
							'addDate' => $current_time
					);
					$this->session->set_userdata("data_role", $data_role);
					//$this->db->insert('user_roles', $data_role);
					
					
					// Insert into Tree
					$pid = get_ID_by_username($_POST['p_id']);
					$ref_id = get_ID_by_username($_POST['ref_id']);
					$spon_id = get_ID_by_username($_POST['spon_id']);
					$data_tree = array(
							'u_id' => 0,
							'pr_id' => $pid,
							'ref_id' => $ref_id,
							'agent_id' => $this->session->userdata('user_id'),
							'spon_id' => $spon_id
					);
					$this->session->set_userdata("data_tree", $data_tree);
					//$this->db->insert('Tree', $data_tree);
					
					// Update Tree for left and right
					if ($_POST['position'] == 1) {
						$data_left_right = array(
								'l_t' => 0
						);
					}
					if ($_POST['position'] == 2) {
						$data_left_right = array(
								'r_t' => 0
						);
					}
					$this->session->set_userdata("data_left_right", $data_left_right);
					//$this->db->where('u_id', $pid);
					//$this->db->update('Tree', $data_left_right);
					}
				}
			
			
			
			// Add product into cart
			if (isset($_POST['add_to_cart'])) {
			$existing_qty = get_field_by_id('quantity', $_POST['product_id']);
			$product_name = get_field_by_id('name', $_POST['product_id']);
			if ($existing_qty >= $_POST['qty']) {
				$data = array(
				   'id'      => $_POST['product_id'],
				   'qty'     => $_POST['qty'],
				   'price'   => $_POST['price'],
				   'name'    => $_POST['name'],
				   'options' => array('Point' => $_POST['Point'])
				);
				$this->cart->insert($data);
			}else {
				$data['msg'] = '<p class="error">Sorry! We don\'t have that amount of product. We have max ('.$existing_qty.') Products of the iteam: '.$product_name.'<p>';
			}
			}
			
			
			
			// Update cart
			if (isset($_POST['update_cart'])) {
			$i = 1;
			foreach ($this->cart->contents() as $item) {
			$existing_qty = get_field_by_id('quantity', $item['id']);
			$product_name = get_field_by_id('name', $item['id']);
			if ($existing_qty >= $_POST[$i]['qty']) {
				$data = array(
					   'rowid' => $item['rowid'],
					   'qty'   => $_POST[$i]['qty']
					);
				$this->cart->update($data);
			}else {
				$data['msg'] = '<p class="error">Sorry! We don\'t have that many of product. We have max ('.$existing_qty.') Products of the iteam: '.$product_name.'<p>';
			}
			$i++;
			}
			//var_dump($this->cart->contents());
			}
			
			
			
			// Making this cart empty
			if (isset($_POST['empty'])) {
				$this->cart->destroy();
			}
			
		
		$all_user_data = $this->session->all_userdata();
		//var_dump($all_user_data);
		if (!empty($all_user_data['personal_data'])) {
			$personal_info = $all_user_data['personal_data'];
			$data_tree_info = $all_user_data['data_tree'];
			$data['username'] = $personal_info['username'];
			$data['ref_id'] = $data_tree_info['ref_id'];
		}
			
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		$data['timthumb'] = "assets/timthumb.php";
		$data['pro_path'] = "uploads/pro_image/";
		
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
			
			// Agent details
			$data['ID'] = $this->session->userdata('user_id');
			$data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
			$data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
			$data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
			$data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
			$data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
			$data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
			
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$data['sidebar_right'] = $this->load->view('front/client_area/agent/sidebar-right', $data, true);
			$products = $this->db->query("SELECT * FROM `products` WHERE `quantity` > 0");
			$data['pro_query'] = $products->result();
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/agent/store', $data);
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
	
	
	public function buy()
	{
		$this->load->library('cart');
		$all_user_data = $this->session->all_userdata();
		//var_dump($all_user_data);
		$data['msg'] = '';
		$new_point = 0;
		$new_balance = 0;
		
		// If everything is complete, then need to move to confirm
		if (isset($_POST['complete'])) {
			if (!empty($all_user_data['personal_data'])) {
				$personal_info = $all_user_data['personal_data'];
				$data_tree_info = $all_user_data['data_tree'];
				$data['username'] = $personal_info['username'];
				$data['ref_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data_tree_info['ref_id']);
				$data['agent_id'] = $all_user_data['user_id'];
			}else {
				$data['username'] = $_POST['username'];
				$data['ref_name'] = $_POST['ref_name'];
				$data['agent_id'] = $_POST['agent_id'];
			}
		}
		
		
		
		// If user confirm to purchase products
		if (isset($_POST['confirm'])) {
			$total_price  = $this->cart->total();
			$product_into = array();
			foreach ($this->cart->contents() as $item) {
			$product_into[$item['id']] = $item['qty'];
			$new_point = $new_point + ($item['options']['Point'] * $item['qty']); // Count Point with quantity of each products
			}
			$data['pro_info'] = json_encode($product_into);
			
			
			// Select data according to personal data
			if (!empty($all_user_data['personal_data'])) {
				$personal_info = $all_user_data['personal_data'];
				$data_tree_info = $all_user_data['data_tree'];
				$data['username'] = $personal_info['username'];
				$data['ref_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data_tree_info['ref_id']);
				$data['ref_id'] = $data_tree_info['ref_id'];
				$data['agent_id'] = $all_user_data['user_id'];
			}else {
				$data['username'] = $_POST['username'];
				$data['ref_name'] = $_POST['ref_name'];
				$data['ref_id'] = get_userid_by_username($data['ref_name']);
				$data['agent_id'] = $_POST['agent_id'];
			}
			
			
			// Select data according to username
			if (check_username($data['username']) === TRUE) {
				$data['user_id'] = get_userid_by_username($data['username']);
				$user_old_point = get_point_by_id($data['user_id']);
				$min_point = 0;
			}else{
				$data['user_id'] = 0;
				$user_old_point = 0;
				$min_point = 5;
			}
			
			
			$agent_existing_balance = get_balance_by_id($data['agent_id']);
			$agent_existing_commission = get_commission_by_id($data['agent_id']);
			//$spon_existing_commission = get_commission_by_id($all_user_data['data_tree']['spon_id']);
			
		
			if ($this->cart->total_items()>0) {  // If cart is empty
				if ($agent_existing_balance < $total_price) { // If don't have much balance
					$data['msg'] = '<p class="error">You do not have enough balance.</p>';
				}else {
					if ($new_point >= $min_point) {
						if (!empty($all_user_data['personal_data'])) {
							
							if (check_username($data['username']) == FALSE) {
							// Move image from temp file to main user file
							$image_file_name = $all_user_data['config']['file_name'];
							$file = FCPATH."uploads/temp/".$image_file_name;
							$destination = FCPATH."uploads/user_image/".$image_file_name;
							copy($file, $destination);
							unlink($file);
								
							//Insert into user
							$personal_data = $all_user_data['personal_data'];
							$this->db->insert('users', $personal_data);
							
							
							//Insert user role
							$data['user_id'] = mysql_insert_id();
							$data_role = $all_user_data['data_role'];
							$replace_new_user_id = array('userID' => $data['user_id']);
							$new_data_role = array_replace($data_role, $replace_new_user_id);
							$this->db->insert('user_roles', $new_data_role);
							unset($data_role);
							unset($new_data_role);
							unset($all_user_data['data_role']);
							
							
							//Insert into Tree
							$data_tree = $all_user_data['data_tree'];
							$replace_new_user_id = array('u_id' => $data['user_id']);
							$new_data_tree = array_replace($data_tree, $replace_new_user_id);
							$this->db->insert('Tree', $new_data_tree);
							$data['t_id'] = mysql_insert_id();
							
							
							//update Left right data
							$data_left_right = $all_user_data['data_left_right'];
							$keys = array_keys($data_left_right);
							$replace_new_user_id = array($keys[0] => $data['user_id']);
							$new_data_left_right = array_replace($data_left_right, $replace_new_user_id);
							$this->db->where('u_id', $data_tree['pr_id']);
							$this->db->update('Tree', $new_data_left_right);
							unset($data_tree);
							unset($data_left_right);
							unset($new_data_left_right);
							unset($all_user_data['data_left_right']);
							}
						
						}
					
					
					// User Point will be increase
					$user_info = array(
							'Point' => $user_old_point + $new_point
							);
					$this->db->where('ID', $data['user_id']);
					$this->db->update('users', $user_info);
					
					// Agent balance will be decrease
					$agent_info = array(
							'balance' => $agent_existing_balance - $total_price
							);
					$this->db->where('ID', $data['agent_id']);
					$this->db->update('users', $agent_info);
					
					// Decrease product quantity
					foreach ($this->cart->contents() as $item) {
						$existing_qty = get_quantity_by_id($item['id']);
						$product_info = array(
							'quantity' => $existing_qty - $item['qty']
							);
						$this->db->where('pro_id', $item['id']);
						$this->db->update('products', $product_info);
					}
					
					// Sales information will be added
					$inv_id = time();
					$sale_info = array(
							'inv_id' => $inv_id,
							'u_id' => $data['user_id'],
							'ref_id' => $data['ref_id'],
							'agent_id' => $data['agent_id'],
							'pro_info' => $data['pro_info']
							);
					$this->db->insert('sales', $sale_info);
					
					
					//Agent commision statement (Insert into 'comm_agent')
					$data['sale_id'] = mysql_insert_id();
					$new_commission = $new_point * get_field_by_id_from_table("global_settings", "value", "title", "agent_commission");
					$agent_com_state = array(
							'u_id' => $this->session->userdata('user_id'),
							'purpose' => "On product purchace of a register new member",
							'sale_id' => $data['sale_id'],
							'amount' => $new_commission
							);
					$this->db->insert('comm_agent', $agent_com_state);
					
					
					//Agent commision will be added
					$total_commission = $agent_existing_commission + $new_commission;
					$agent_com = array(
							'commission' => $total_commission
							);
					$this->db->where('ID', $this->session->userdata('user_id'));
					$this->db->update('users', $agent_com);
					
					
					
					// Sponsor commission
					if (!empty($all_user_data['personal_data'])) {
						if (!empty($new_data_tree)) {
							$spon_existing_commission = get_commission_by_id($all_user_data['data_tree']['spon_id']);
							//Sponsor commision statement (Insert into 'comm_spot')
							$sponsor_commission = $new_point * get_field_by_id_from_table("global_settings", "value", "title", "sponsor_commission");
							$spon_com_state = array(
									'u_id' => $all_user_data['data_tree']['spon_id'],
									'purpose' => "Sponsor commission of a register new member",
									't_id' => $data['t_id'],
									'amount' => $sponsor_commission
									);
							$this->db->insert('comm_spot', $spon_com_state);
							
							
							//Sponsor commision will be added
							$total_spon_commission = $spon_existing_commission + $sponsor_commission;
							$spon_com = array(
									'commission' => $total_spon_commission
									);
							$this->db->where('ID', $all_user_data['data_tree']['spon_id']);
							$this->db->update('users', $spon_com);
							
							unset($all_user_data['data_tree']);
							unset($new_data_tree);
					}
					}
					
					
					
					
					//Matching Commission
					$parent_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $data['user_id']);
					$existing_com = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
					$com_taken_on_day = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = $parent_id AND `date` BETWEEN '".date("Y-m-d")." 00:00:00' AND '".date("Y-m-d")." 23:59:59'")->num_rows();
					if ($com_taken_on_day < 40) {
						$min_matching_com = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");
						$l_t = get_field_by_id_from_table("Tree", "l_t", "u_id", $parent_id);
						$r_t = get_field_by_id_from_table("Tree", "r_t", "u_id", $parent_id);
						if(!empty($l_t) && !empty($r_t)) {
							$l_t_point = get_field_by_id_from_table("users", "Point", "ID", $l_t);
							$r_t_point = get_field_by_id_from_table("users", "Point", "ID", $r_t);
							$left_com_number = floor($l_t_point/$min_matching_com);
							$right_com_number = floor($r_t_point/$min_matching_com);
							$total_com_taken = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = $parent_id")->num_rows();
							if (($left_com_number > $total_com_taken) && ($right_com_number > $total_com_taken)) {
									//$rec_com = $min_matching_com * $total_com_taken;
									$left_rest_com = $l_t_point - ($total_com_taken * $min_matching_com);
									$right_rest_com = $r_t_point - ($total_com_taken * $min_matching_com);
									if (($left_rest_com >= $min_matching_com) && ($right_rest_com >= $min_matching_com)) {
										$how_much_left = floor($left_rest_com/$min_matching_com);
										$how_much_right = floor($right_rest_com/$min_matching_com);
										if ($how_much_left > $how_much_right) {
											$next_com_times =  $how_much_right;
										}else {
											$next_com_times =  $how_much_left;
										}
										$next_com = $existing_com + ($min_matching_com * $next_com_times);
										
										// Updating commission on user table
										$data = array(
										   'commission' => $next_com
										);
										$this->db->where('ID', $parent_id);
										$this->db->update('users', $data);
										
										
										//Inserting into matching commission table
										for($i=1; $i<=$next_com_times; $i++) {
											$data = array(
											   'u_id' => $parent_id,
											   'purpose' => 'Matching Commission',
											   'amount' => $min_matching_com
											);
											$this->db->insert('comm_matching', $data); 
										}
										
									}
							}
						}
					}


					$data['msg'] = '<p class="success">Successfully Purchased</p>';
					$this->cart->destroy();
					}else { $data['msg'] = '<p class="error">Sorry! you have to purchase minimum 5 points.</p>'; }
				}
			}else {
				$data['msg'] = '<p class="error">Sorry! Your cart is Empty.</p>';
			}
			
		}
			
			
			
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		$data['timthumb'] = "assets/timthumb.php";
		$data['pro_path'] = "uploads/pro_image/";
		
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
			if ($data['role'] == 4) {
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$data['sidebar_right'] = $this->load->view('front/client_area/agent/sidebar-right', $data, true);
			$products = $this->db->query("SELECT * FROM `products`");
			$data['pro_query'] = $products->result();
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/agent/buy', $data);
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
	
	
	
		
}

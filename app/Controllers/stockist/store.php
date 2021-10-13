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
		
		$this->load->helper('stockist_helper');
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
			$data['sidebar_right'] = $this->load->view('front/client_area/stockist/sidebar-right', $data, true);
			$products = $this->db->query("SELECT * FROM `products` WHERE `quantity` > 0 ORDER BY `pro_id` DESC");
			$data['pro_query'] = $products->result();
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/stockist/store', $data);
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

		
		//If user confirm to purchase products
		if (isset($_POST['confirm'])) {
			$total_price  = $this->cart->total();
			$product_into = array();
			foreach ($this->cart->contents() as $item) {
			$product_into[$item['id']] = $item['qty'];
			$new_point = $new_point + ($item['options']['Point'] * $item['qty']); // Count Point with quantity of each products
			}
			$data['pro_info'] = json_encode($product_into);
			
			
			// Select data according to personal data
			$data['stockist_id'] = $_POST['stockist_id'];
		
			
			
			// Select data according to username
			$user_old_point = get_point_by_id($data['stockist_id']);
			$min_point = 0;
			
			
			
			$agent_existing_balance = get_balance_by_id($data['stockist_id']);
			$agent_existing_commission = get_commission_by_id($data['stockist_id']);
			//$spon_existing_commission = get_commission_by_id($all_user_data['data_tree']['spon_id']);
			
		
			if ($this->cart->total_items()>0) {  // If cart is empty
				if ($agent_existing_balance < $total_price) { // If don't have much balance
					$data['msg'] = '<p class="error">You do not have enough balance.</p>';
				}else {
					if ($new_point >= $min_point) {
					
					// Stockist balance will be decrease
					$agent_info = array(
							'balance' => $agent_existing_balance - $total_price
							);
					$this->db->where('ID', $data['stockist_id']);
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
							'stockist_id' => $data['stockist_id'],
							'amount' => $total_price,
							'pro_info' => $data['pro_info']
							);
					$this->db->insert('sales_stockist', $sale_info);
					

					//Stockist product information table
					$existance = check_userid($data['stockist_id'], 'stockist_product');
					if ($existance == TRUE) {
						$get_pro_info = $this->db->query("SELECT `pro_info` FROM `stockist_product` WHERE `stockist_id` = ".$data['stockist_id'])->row()->pro_info;
						$existing_product_array = (array) json_decode($get_pro_info, true);
						$purchased_product = (array) json_decode($data['pro_info'], true);
						$new_product_array = $existing_product_array;
						$new_item = false;
						foreach($purchased_product as $key=>$val) {
								if (array_key_exists($key, $existing_product_array)) {
									$new_product_array[$key] = $existing_product_array[$key]+$val;
								}else {
									$new_product_array[$key] = $val;
								}
						}
						$new_product_json = json_encode($new_product_array);
						$sp_info = array(
							'last_amount' => $total_price,
							'pro_info' => $new_product_json
						);
						$this->db->where('stockist_id', $data['stockist_id']);
						$this->db->update('stockist_product', $sp_info); 
					}else {
						$sp_info = array(
							'stockist_id' => $data['stockist_id'],
							'last_amount' => $total_price,
							'pro_info' => $data['pro_info']
						);
						$this->db->insert('stockist_product', $sp_info);
					}

					
					//Stockist product information table 2
					$existance = check_userid($data['stockist_id'], 'stockist_product');
					foreach ($this->cart->contents() as $item) {
						$stockist_product = array(
							'stockist_id' => $data['stockist_id'],
							'pro_id' => $item['id'],
							'name' => $item['name'],
							'Point' => $item['options']['Point'],
							'quantity' => $item['qty'],
							'price' => $item['subtotal']
						);
						$this->db->insert('stockist_products_2', $stockist_product);
					}
					
					
					//Stockist commision statement (Insert into 'comm_stockist')
					$data['sale_id'] = $this->db->insert_id();
					$new_commission = $new_point * get_field_by_id_from_table("global_settings", "value", "title", "stockist_commission");
					$stockist_com_state = array(
							'u_id' => $this->session->userdata('user_id'),
							'purpose' => "On product purchace",
							'sale_id' => $data['sale_id'],
							'amount' => $new_commission
							);
					$this->db->insert('comm_stockist', $stockist_com_state);
					
					
					//Stockist commision will be added
					$total_commission = $agent_existing_commission + $new_commission;
					$stockist_com = array(
							'commission' => $total_commission
							);
					$this->db->where('ID', $this->session->userdata('user_id'));
					$this->db->update('users', $stockist_com);
					
					
					
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
			if ($data['role'] == 5) {
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$data['sidebar_right'] = $this->load->view('front/client_area/stockist/sidebar-right', $data, true);
			$products = $this->db->query("SELECT * FROM `products`");
			$data['pro_query'] = $products->result();
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/stockist/buy', $data);
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

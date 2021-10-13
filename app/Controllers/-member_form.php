<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_form extends CI_Controller {

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
			$data['ID'] = $this->session->userdata('user_id');
			$data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
			$data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
			$data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
			$data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
			$data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
			$data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
			$this->load->view('front/client_area/header', $data);
			$this->load->view('front/client_area/member_form', $data);
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
	
	
	
	/*public function my_tree($user_id=0)
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
		
	}*/
	



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
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|xss_clean');
			
			if ($this->form_validation->run() == TRUE) {
				$login = $this->user_login->login_member();
			}
		}
		
		//print $this->m_logged_in;
		if (($this->m_logged_in == true) || ($login)) {

            if ($this->session->userdata('role') == 4) { redirect("agent/dashboard/"); }
		    redirect("member/dashboard/");
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
		    redirect("member/dashboard/");
//			$data['log_url'] = 'member_form/logout_member.html';
//			$data['log_title'] = 'Logout';
//			$data['check_user'] = $this->session->userdata('m_logged_in');
//			$data['ID'] = $this->session->userdata('user_id');
//			$data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
//			$data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
//			$data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
//			$data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
//			$data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
//			$data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
//			$data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
//			$this->load->view('front/client_area/header', $data);
//			$this->load->view('front/register', $data);
//			$this->load->view('front/client_area/footer', $data);
		}else{
			$data['check_user'] = '';
			$data['log_url'] = 'member_form/login.html';
			$data['log_title'] = 'Login';
			$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
			$this->load->view('front/header', $data);
			$this->load->view('front/register', $data);
			$this->load->view('front/footer', $data);
		}
		
		
	}



	function register_action(){


        if (isset($_POST['add_user'])) {
            $this->rules();

            if ($this->form_validation->run() == TRUE) {

                $position = $this->input->post('position');
                if (($position == 1) || ($position == 2)) {

                $this->db->trans_start();	

                    // Insert into user
                    $data_personal = array(
                        'email' => $_POST['email'],
                        'username' => $_POST['uname'],
                        'password' => md5($_POST['pass']),
                        'f_name' => $_POST['fname'],
                        'balance' => '0',
                        'Point' => '0',
                        'status' => 'Inactive'
                    );                    
                    $this->db->insert('users', $data_personal);
                    $userID = $this->db->insert_id();

                    // Insert into user_role
                    $current_time = date('Y-m-d h:m:s');
                    $data_role = array(
                        'userID' => $userID,
                        'roleID' => 6,
                        'addDate' => $current_time
                    );
                    $this->db->insert('user_roles', $data_role);

                    // Insert into Tree
                    $pid = get_ID_by_username($_POST['p_id']);
                    //$ref_id = get_ID_by_username($_POST['ref_id']);
                    $spon_id = get_ID_by_username($_POST['spon_id']);
                    $data_tree = array(
                        'u_id' => $userID,
                        'pr_id' => $pid,
                        'agent_id' => $this->session->userdata('user_id'),
                        'spon_id' => $spon_id
                    );
                    $this->db->insert('Tree', $data_tree);

                    // Update Tree for left and right
                    if ($_POST['position'] == 1) {
                        $data_left_right = array(
                            'l_t' => $userID
                        );
                    }
                    if ($_POST['position'] == 2) {
                        $data_left_right = array(
                            'r_t' => $userID
                        );
                    }
                    $this->db->where('u_id', $pid);
                    $this->db->update('Tree', $data_left_right);

                    //pin update
                    $pin = array(
                    				'pin' =>$this->input->post('pin',TRUE), 
                    				'status'=>'used'
                				);
                    $this->db->where('pin', $_POST['pin']);
                    $this->db->update('pins', $pin);

	                //Sponsor commision will be added to main Commission
	                $spon_id = get_field_by_id_from_table("Tree", "spon_id", "u_id", $userID);
	                $spons_previous_bal = get_field_by_id_from_table("users", "commission", "ID", $spon_id);
	                $sponsor_com = get_field_by_id_from_table("global_settings", "value", "title", "sponsor_commission");
	                $sponsor_commision = array(
	                    'commission' => $spons_previous_bal + $sponsor_com,
	                );
	                $this->db->where('ID', $spon_id);
	                $this->db->update('users', $sponsor_commision);

	                // Sponsor commission Statement
	                $spon_commision_statement = array(
	                    'u_id' => $spon_id,
	                    'purpose' => "Sponsor commission of a register new member",
	                    'amount' => $sponsor_com,
	                    'date' => date("Y-m-d h:i:s")
	                );
	                $this->db->insert('comm_spot', $spon_commision_statement);


	                //sponsor commision is deducting from admin balance 
	                $adminBalance = get_field_by_id_from_table('users', 'balance', 'ID', 1);
			        $adminBalanceCRspon = $adminBalance-$sponsor_com;
			        $adminBalanceCRdataspon = array(
			            'balance' => $adminBalanceCRspon,
			        );
			        $this->db->where('ID', 1);
			        $this->db->update('users', $adminBalanceCRdataspon);

			        //admin balance history
			        $hisBalanceadminspon = array(
					    'user_id' => 1,
						'amount' => $sponsor_com,
						'type' => 'CR',
						'purpose'=>'spon_commission',
					);
				    $this->db->insert('history_balance_admin', $hisBalanceadminspon);

	                //All Users Perent_point will be increased And matching
	                $min_matching_point = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");
	                $per_day_matching = get_field_by_id_from_table("global_settings", "value", "title", "per_day_matching");
	                $matching_commission = get_field_by_id_from_table("global_settings", "value", "title", "matching_commission");

	                $parent_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $userID);
	                $user_id = $userID;

	                while (!empty($parent_id)) {

	                    $old_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
	                    $old_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

	                    //Increasing Parent hand Point (left or right)
	                    $this->db->select('l_t, r_t');
	                    $this->db->from('Tree');
	                    $this->db->where("u_id", $parent_id);
	                    $hand = $this->db->get()->row();
	                    if ($hand->l_t == $user_id) {
	                        $point_hand = "lpoint";
	                    }
	                    if ($hand->r_t == $user_id) {
	                        $point_hand = "rpoint";
	                    }
	                    $old_point = get_field_by_id_from_table("users", $point_hand, "ID", $parent_id);
	                    $pr_point = array(
	                        $point_hand => $old_point + $min_matching_point
	                    );
	                    $this->db->where('ID', $parent_id);
	                    $this->db->update('users', $pr_point);

	                    //Adding history of points
	                    $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
	                    $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
	                    $current_commission = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
	                    $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
	                    $history_point_data = array(
	                        'u_id' => $parent_id,
	                        $point_hand => $min_matching_point,
	                        'current_left_point' => $current_lpoint,
	                        'current_right_point' => $current_rpoint,
	                        'current_commission' => $current_commission,
	                        'current_balance' => $current_balance,
	                        'type' => "Add",
	                        'date' => date("Y-m-d h:i:s")
	                    );
	                    $this->db->insert('history_point', $history_point_data);

	                    //Matching Commission
	                    $com_taken_on_day = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = $parent_id AND `date` BETWEEN '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59'")->num_rows();
	                    if ($com_taken_on_day < $per_day_matching) {

	                        $lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
	                        $rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

	                        if (($lpoint >= $min_matching_point) && ($rpoint >= $min_matching_point) && !empty($hand->l_t) && !empty($hand->r_t)) {

	                            $existing_com = get_field_by_id_from_table("users", "commission", "ID", $parent_id);

	                            // Updating commission on user table
	                            $data = array(
	                                'commission' => $existing_com + $matching_commission
	                            );
	                            $this->db->where('ID', $parent_id);
	                            $this->db->update('users', $data);

	                            //$matching_commission;
                                $data = array(
                                    'u_id' => $parent_id,
                                    'purpose' => 'Matching Commission'.date("Y-m-d h:i:s A"),
                                    'amount' => $matching_commission,
                                    'date' => date("Y-m-d h:i:s")
                                );
                                $this->db->insert('comm_matching', $data);


	                            //matching_commission is deducting from admin balance
	                            $adminBalanceNew = get_field_by_id_from_table('users', 'balance', 'ID', 1);
			                    $adminBalanceCR = $adminBalanceNew - $matching_commission;
			                    $adminBalanceCRdata = array(
			                    		'balance' => $adminBalanceCR,
			                    		 );
			                    $this->db->where('ID', 1);
			                    $this->db->update('users', $adminBalanceCRdata);

			                    //admin balance history
			                    $hisBalanceadmin = array(
					      			'user_id' => 1,
									'amount' => $matching_commission,
									'type' => 'CR',
									'purpose'=>'matching_commission',
								);
				            	$this->db->insert('history_balance_admin', $hisBalanceadmin);




	                            //Decreasing Left Point
	                            //$matching_point = $next_com_times * $min_matching_point;
	                            $left_data = array(
	                                'lpoint' => $lpoint - $min_matching_point,
	                                'rpoint' => $rpoint - $min_matching_point
	                            );
	                            $this->db->where('ID', $parent_id);
	                            $this->db->update('users', $left_data);

	                            //Deducting history of points
	                            $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
	                            $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
	                            $current_commission = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
	                            $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
	                            $deducting_point_data = array(
	                                'u_id' => $parent_id,
	                                'lpoint' => $min_matching_point,
	                                'rpoint' => $min_matching_point,
	                                'current_left_point' => $current_lpoint,
	                                'current_right_point' => $current_rpoint,
	                                'current_commission' => $current_commission,
	                                'current_balance' => $current_balance,
	                                'type' => "Deduct",
	                                'date' => date("Y-m-d h:i:s")
	                            );
	                            $this->db->insert('history_point', $deducting_point_data);

	                        }

	                    }

	                    //Flash existing Point after 25
	                    //$total_comm_taken = $com_taken_on_day + 1;
	                    if ($com_taken_on_day >= $per_day_matching) {

	                        if ($old_lpoint <> $old_rpoint) {
	                            if ($old_lpoint > $old_rpoint) {
	                                $flash_hand = "rpoint";
	                            } else {
	                                $flash_hand = "lpoint";
	                            }

	                            $flashdata = array(
	                                $flash_hand => 0
	                            );
	                            $this->db->where('ID', $parent_id);
	                            $this->db->update('users', $flashdata);

	                            //Flushing history of points
	                            $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
	                            $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
	                            $current_commission = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
	                            $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
	                            $flushing_point_data = array(
	                                'u_id' => $parent_id,
	                                $flash_hand => $min_matching_point,
	                                'current_left_point' => $current_lpoint,
	                                'current_right_point' => $current_rpoint,
	                                'current_commission' => $current_commission,
	                                'current_balance' => $current_balance,
	                                'type' => "Flush",
	                                'date' => date("Y-m-d h:i:s")
	                            );
	                            $this->db->insert('history_point', $flushing_point_data);

	                       	}

	                    }
	                    $user_id = $parent_id;
	                    $parent_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $parent_id);
	                }

                $this->db->trans_complete();

                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>Successfully Registered. Please Login</div>");
                    redirect("member_form/login/");

                }else {
                    $this->session->set_flashdata("msg", '<div class="alert alert-warning">Sorry! You did not select any position.</div>');
                    redirect("member_form/register/");
                }
            }else{
                $this->session->set_flashdata("msg", validation_errors('<div class="alert alert-warning">', '</div>'));
                redirect("member_form/register/");
            }
        }else{
            redirect("member_form/register/");
        }


    }
	
	
    private function rules() {
        $this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('phone', 'Phone', 'xss_clean|encode_php_tags|is_natural');
        $this->form_validation->set_rules('spon_id', 'Sponsor ID', 'required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('p_id', 'Placement ID', 'required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('position', 'Hand/Position', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]|is_natural_no_zero');
        $this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|max_length[20]|is_unique[users.username]');
        $this->form_validation->set_rules('pass', 'Password', 'required|matches[con_pass]|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('con_pass', 'Password Confirmation', 'required||min_length[6]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
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

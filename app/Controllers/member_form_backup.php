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
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[10]|xss_clean');
			
			if ($this->form_validation->run() == TRUE) {
				$login = $this->user_login->login_member();
			}
		}
		
		if (($this->m_logged_in == true) || ($login)) {
			$data['check_user'] = $this->session->userdata('m_logged_in');
			$data['ID'] = $this->session->userdata('user_id');
			$data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
			$data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
			$data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
			$data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
			$data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
			$data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
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
			$this->load->view('front/register', $data);
			$this->load->view('front/client_area/footer', $data);
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
                    'l_name' => "no_need",
                    'address1' => "no_need",
                    'phn_no' => $_POST['phone'],
                    'balance' => '0',
                    'Point' => '0',
                    'status' => 'Inactive',
                    'address2' => "no_need",
                    'religion' => "no_need",
                    'sex' => "no_need",
                    'photo' => "no_need.jpg"
                );
                $this->db->insert('users', $data_personal);
                $userID = $this->db->insert_id();


                // Insert into user_role
                $current_time = date('Y-M-D h:m:s');
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
                    'ref_id' => "no_need",
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
            }



            //Sponsor commision will be added to main Commission
            $previous_bal = get_field_by_id_from_table("users", "commission", "ID", $spon_id);
            $sponsor_com = get_field_by_id_from_table("global_settings", "value", "title", "sponsor_commission");
            $sponsor_commision = array(
                'commission' => $previous_bal + $sponsor_com,
            );
            $this->db->where('ID', $spon_id);
            $this->db->update('users', $sponsor_commision);
            print $this->db->last_query();
            print "<br />";
            print_r($sponsor_commision);
            print "<br />";


            // Sponsor commission Statement
            $spon_commision_statement = array(
                'u_id' => $spon_id,
                'purpose' => "Sponsor commission of a register new member",
                'amount' => $sponsor_com,
            );
            $this->db->insert('comm_spot', $spon_commision_statement);
            print $this->db->last_query();
            print "<br />";
            print_r($spon_commision_statement);
            print "<br />";



            //All Users Perent_point will be increased
            $active_account_point = get_field_by_id_from_table("global_settings", "value", "title", "active_account_point");
            $user_id = $userID;
            while(!empty($user_id)) {
                $usernames = get_username_by_id($user_id);
                if (check_username($usernames) === TRUE) {
                    $old_point = get_pr_point_by_id($user_id);
                }else{
                    $old_point = 0;
                }
                $pr_point = array(
                    'pr_point' => $old_point + $active_account_point
                );
                $this->db->where('ID', $user_id);
                $this->db->update('users', $pr_point);
                $user_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $user_id);
            }




            // User Point will be increase
            $user_old_point = get_point_by_id($userID);
            $user_info = array(
                'pr_point' => $user_old_point + $active_account_point
            );
            $this->db->where('ID', $userID);
            $this->db->update('users', $user_info);
            print $this->db->last_query();
            print "<br />";
            print_r($user_info);
            print "<br />";







            //Matching Commission
            $parent_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $userID);
            print "Parent ID: ".$parent_id;
            print "<br />";
            while(!empty($parent_id)) {
                $existing_com = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
                $com_taken_on_day = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = $parent_id AND `date` BETWEEN '".date("Y-m-d")." 00:00:00' AND '".date("Y-m-d")." 23:59:59'")->num_rows();
                if ($com_taken_on_day < 25) {
                    $min_matching_point = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");
                    $matching_per_point = get_field_by_id_from_table("global_settings", "value", "title", "matching_commission");
                    $l_t = get_field_by_id_from_table("Tree", "l_t", "u_id", $parent_id);
                    print "Left ID: ".$l_t;
                    print "<br />";
                    $r_t = get_field_by_id_from_table("Tree", "r_t", "u_id", $parent_id);
                    print "Right ID: ".$r_t;
                    print "<br />";

                    if(!empty($l_t) && !empty($r_t)) {
                        $l_t_point = get_field_by_id_from_table("users", "pr_point", "ID", $l_t);
                        print "Left Point : " . $l_t_point;
                        print "<br />";
                        $r_t_point = get_field_by_id_from_table("users", "pr_point", "ID", $r_t);
                        print "Right Point : " . $r_t_point;
                        print "<br />";


                        if (($l_t_point >= $min_matching_point) && ($r_t_point >= $min_matching_point)) {
                            /*$how_much_left = floor($l_t_point/$min_matching_point);
                            $how_much_right = floor($r_t_point/$min_matching_point);
                            if ($how_much_left > $how_much_right) {
                                $next_com_times =  $how_much_right;
                            }else {
                                $next_com_times =  $how_much_left;
                            }*/
                            $matching_points =  $min_matching_point*2;
                            $parent_point = get_field_by_id_from_table("users", "pr_point", "ID", $parent_id);
                            if ($parent_point >= $matching_points) {
                                $next_com_times = floor($parent_point / $min_matching_point);

                                $matching_com_taken_point = $min_matching_point * $next_com_times;
                                //$total_point = $each_side_com_point*2;
                                $matching_com = $matching_per_point * $matching_com_taken_point;
                                print "Matching Com: " . $matching_com;
                                print "<br />";
                                //print "<br /> Matching Comm: ";
                                //print $matching_com;
                                $next_com = $existing_com + $matching_com;
                                print "Total Next Com: " . $next_com;
                                print "<br />";
                                //print "<br /> Next Comm: ";
                                //print $next_com;

                                // Updating commission on user table
                                $data = array(
                                    'commission' => $next_com
                                );
                                $this->db->where('ID', $parent_id);
                                $this->db->update('users', $data);
                                print $this->db->last_query();
                                print "<br />";
                                print_r($data);
                                print "<br />";
                                //print_r($data);
                                //print "<br /> Parent Id: ";
                                //print $parent_id;


                                //Inserting into matching commission table
                                for ($i = 1; $i <= $next_com_times; $i++) {
                                    $data = array(
                                        'u_id' => $parent_id,
                                        'purpose' => 'Matching Commission',
                                        'amount' => $matching_com_taken_point * $matching_per_point
                                    );
                                    $this->db->insert('comm_matching', $data);
                                    print $this->db->last_query();
                                    print "<br />";
                                    print_r($data);
                                    print "<br />";
                                }


                                //Decreasing Parent pr_point
                                $parent_rest_point = $parent_point - $matching_com_taken_point;
                                $parent_point_data = array(
                                    'pr_point' => $parent_rest_point
                                );
                                $this->db->where('ID', $parent_id);
                                $this->db->update('users', $parent_point_data);
                                print $this->db->last_query();
                                print "<br />";
                                print_r($parent_point_data);
                                print "<br />";


                            }





                            /*
                            //Decreasing Left id pr_point
                            $left_rest_point = $l_t_point - $each_side_com_point;
                            $left_data = array(
                                'pr_point' => $left_rest_point
                            );
                            $this->db->where('ID', $l_t);
                            $this->db->update('users', $left_data);
                            print $this->db->last_query();
                            print "<br />";
                            print_r($left_data);
                            print "<br />";

                            //Decreasing right id pr_point
                            $right_rest_point  = $r_t_point - $each_side_com_point;
                            $right_data = array(
                                'pr_point' => $right_rest_point
                            );
                            $this->db->where('ID', $r_t);
                            $this->db->update('users', $right_data);
                            print $this->db->last_query();
                            print "<br />";
                            print_r($right_data);
                            print "<br />";

                            */



                        }
                    }
                }
                $parent_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $parent_id);
                print "Parent ID: ". $parent_id;
                print "<br />";
                print "<br />";
                print "<br />";
                print "<br />";
            }






            $this->session->set_flashdata("msg", "<p class='success'>Successfully Registered. Please Login</p>");
            //redirect("member/dashboard/");
            exit();
        }





        $all_user_data = $this->session->all_userdata();
        // Select data according to personal data
        if (!empty($all_user_data['personal_data'])) {
            $personal_info = $all_user_data['personal_data'];
            $data_tree_info = $all_user_data['data_tree'];
            $data['username'] = $personal_info['username'];
            $data['spon_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data_tree_info['spon_id']);
            $data['spon_id'] = $data_tree_info['spon_id'];
            $data['agent_id'] = $all_user_data['user_id'];
        }else {
            $data['username'] = $_POST['username'];
            $data['spon_name'] = $_POST['spon_name'];
            $data['spon_id'] = get_userid_by_username($data['spon_name']);
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
    }
	
	
    private function rules() {
        $this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('phone', 'Phone', 'xss_clean|encode_php_tags|is_natural');
        $this->form_validation->set_rules('spon_id', 'Sponsor ID', 'required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('p_id', 'Placement ID', 'required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('position', 'Side', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|max_length[20]|is_unique[users.username]');
        $this->form_validation->set_rules('pass', 'Password', 'required|matches[con_pass]|min_length[10]|max_length[20]');
        $this->form_validation->set_rules('con_pass', 'Password Confirmation', 'required||min_length[10]|max_length[20]');
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

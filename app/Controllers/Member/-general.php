<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class general extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('settings_functions_helper');
		$this->load->database();
		$this->load->model('functions');
		$this->load->model('users/user_login');
        $this->load->model('settings/global_settings');
        $this->load->helper('student_functions_helper');
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}

	}

	public function index(){
	    redirect("member/general/dashboard/");
    }

	public function dashboard($user_id=0)
	{

        $data["dwn_path"] = base_url()."uploads/downloads/";
        $notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
        if ($notice_list->num_rows() > 0)
        {
            $data["list_notice"] = $notice_list->result();
        }else {
            $data["list_notice"] = "No notice published";
        }

        $data["footer_widget_title"] = $this->functions->show_widget("title", 8);
        $data["footer_widget_description"] = $this->functions->show_widget("description", 8);

        $data["footer_widget2_title"] = $this->functions->show_widget("title", 9);
        $data["footer_widget2_description"] = $this->functions->show_widget("description", 9);

        $data["page_title"] = "home";
        $data["slider"] = "";

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

            $query = $this->db->get_where('users', array('ID'=>$data['ID']));
            $data['row'] = $query->row();

            $data['query'] = $this->db->query('SELECT * FROM `Tree` WHERE `ref_id`= '.$data['ID'].' ORDER BY `t_id` DESC LIMIT 0 , 10');

            $this->load->view('front/client_area/member/dashboard', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }
		
	}


    public function tree($user_id=0)
    {
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
            $data['photo'] = get_field_by_id_from_table('users', 'photo', 'ID', $data['ID']);
            $data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
            $data['lpoint'] = get_field_by_id_from_table('users', 'lpoint', 'ID', $data['ID']);
            $data['rpoint'] = get_field_by_id_from_table('users', 'rpoint', 'ID', $data['ID']);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);


            $data['p_id']= empty($user_id) ? get_field_by_id_from_table('Tree', 'pr_id', 'u_id', $data['ID']) : get_field_by_id_from_table('Tree', 'pr_id', 'u_id', $user_id);
            if (($user_id == $data['ID']) || (empty($user_id))) { $data['p_id'] = ""; }

            if (isset($_POST['search_member'])) {
                $user_id = get_ID_by_username($_POST['member_user']);
            }
            $data['user_id'] = $user_id;

            $data['com_taken_matching'] = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = ".$data['ID'])->num_rows();
            $data['min_matching_com'] = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");

            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);

            $this->load->view('front/client_area/header', $data);
            $this->load->view('front/client_area/member/Tree', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }




    public function profile($user_id=0)
    {
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




            $query = $this->db->get_where('users', array('ID'=>$data['ID']));
            $data['row'] = $query->row();

            $this->load->view('front/client_area/member/profile', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }



    public function referrals($user_id=0)
    {
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


            $data['query'] = $this->db->query('SELECT * FROM `Tree` WHERE `spon_id`= '.$data['ID'].' ORDER BY `t_id` DESC');

            $this->load->view('front/client_area/member/referrals', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }



    public function earnings($user_id=0)
    {

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

            // Commission taken and total amount
            $data['cspot_commis'] = $this->db->query("SELECT SUM(amount) FROM `comm_spot` WHERE `u_id` = ".$data['ID'])->result_array();
            $data['total_matching_amount'] = $this->db->query("SELECT SUM(amount) FROM `comm_matching` WHERE `u_id` = ".$data['ID'])->result_array();
            $data['com_taken_matching'] = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = ".$data['ID'])->num_rows();


            $this->load->view('front/client_area/member/earnings', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }



    public function withdraw_report($user_id=0)
    {

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

            $data['with_match'] = $this->db->get_where('withdrow_req_match', array('form' => $data['ID']));

            $this->load->view('front/client_area/member/withdraw_report', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }




    public function notice($user_id=0)
    {

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

            $data['with_match'] = $this->db->get_where('withdrow_req_match', array('form' => $data['ID']));

            $this->load->view('front/client_area/member/withdraw_report', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }




    public function withdraw($user_id=0)
    {

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
            $data['PM_ID'] = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_ID");
            $data['min_amount_load_PM'] = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_PM");
            $data['min_withdraw_amount_nagad'] = get_field_by_id_from_table('global_settings', 'value', 'title', "min_withdraw_amount_nagad");
            //$data['min_amount_load_nagad'] = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_nagad");
            $data['doller_rate'] = get_field_by_id_from_table('global_settings', 'value', 'title', "doller_rate");
            $data['user_id'] = $user_id;
            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
            $this->load->view('front/client_area/header', $data);


            //query nagad transection list for this user
            $data['nagad_trans'] = $this->db->get_where("history_withdraw_nagad", array("receiver_id" => $data['ID']))->result();

            //query nagad transection list for this user
            $data['PM_trans'] = $this->db->get_where("history_withdraw_pm", array("receiver_id" => $data['ID']))->result();

            $data['query'] = $this->db->query('SELECT * FROM `Tree` WHERE `ref_id`= '.$data['ID'].' ORDER BY `t_id` DESC LIMIT 0 , 10');

            $this->load->view('front/client_area/member/withdraw_money', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }



//     public function withdraw_money_nagad_success()
//     {
//         if ($this->m_logged_in == true) {
//             // Receiving transection data from Perfect Money/PM
//             $nagad_phone = $this->input->post('nagad_number');
//             $amount = $this->input->post('amount');
//             $ID = $this->session->userdata('user_id');
//             $min_withdraw_amount = get_field_by_id_from_table('global_settings', 'value', 'title', "min_withdraw_amount_nagad");
//             $previous_bal_of_user = get_field_by_id_from_table('users', 'balance', 'ID', $ID);
// //            $existing_balance = get_field_by_id_from_table('users', 'balance', 'ID', $ID);
// //            $doller_rate = get_field_by_id_from_table('global_settings', 'value', 'title', "doller_rate");
// //            $bangla_balance = $existing_balance * $doller_rate;
// //            $doller_withdraw_amount = $amount/$doller_rate;


//             if (($amount >= $min_withdraw_amount) && ($amount <= $previous_bal_of_user)) {

//             $this->db->trans_start();
//                 // Discreasing balance of the user
//                 $new_balance_of_user = array(
//                     'balance' => $previous_bal_of_user - $amount
//                 );
//                 $this->db->where('ID', $ID);
//                 $this->db->update('users', $new_balance_of_user);
                
//                 // Added Transection history to history_transection_pm
//                 $nagad_load_data = array(
//                     'receiver_id' => $ID,
//                     'nagad_number' => $nagad_phone,
//                     'amount' => $amount,
//                     'date' => date("Y-m-d h:i:s")
//                 );

//                 $this->db->insert('history_withdraw_nagad', $nagad_load_data);
//                 $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");
//             $this->db->trans_complete();

                
//             }else {
//                 $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! Withdraw did not success.</div>");
                
//             }

//             redirect("member/general/withdraw/");
//         }else{
//             redirect("member_form/login/");
//         }
//     }



    // public function load_money($user_id=0)
    // {

    //     $data['dwn_path'] = base_url()."uploads/downloads/";
    //     $notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
    //     if ($notice_list->num_rows() > 0)
    //     {
    //         $data['list_notice'] = $notice_list->result();
    //     }else {
    //         $data['list_notice'] = 'No notice published';
    //     }

    //     $data['footer_widget_title'] = $this->functions->show_widget('title', 8);
    //     $data['footer_widget_description'] = $this->functions->show_widget('description', 8);

    //     $data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
    //     $data['footer_widget2_description'] = $this->functions->show_widget('description', 9);

    //     $data['page_title'] = 'home';
    //     $data['slider'] = '';


    //     if ($this->m_logged_in == true) {
    //         $data['log_url'] = 'member_form/logout_member.html';
    //         $data['log_title'] = 'Logout';
    //         $data['check_user'] = $this->session->userdata('m_logged_in');
    //         $data['ID'] = $this->session->userdata('user_id');
    //         $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
    //         $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
    //         $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
    //         $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
    //         $data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
    //         $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
    //         $data['PM_ID'] = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_ID");
    //         $data['min_amount_load_PM'] = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_PM");
    //         $data['min_amount_load_nagad'] = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_nagad");
    //         $data['doller_rate'] = get_field_by_id_from_table('global_settings', 'value', 'title', "doller_rate");
    //         $data['user_id'] = $user_id;
    //         $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
    //         $this->load->view('front/client_area/header', $data);


    //         //query nagad transection list for this user
    //         $data['nagad_trans'] = $this->db->get_where("history_transection_nagad", array("receiver_id" => $data['ID']))->result();

    //         //query nagad transection list for this user
    //         $data['PM_trans'] = $this->db->get_where("history_transection_pm", array("receiver_id" => $data['ID']))->result();

    //         $data['query'] = $this->db->query('SELECT * FROM `Tree` WHERE `ref_id`= '.$data['ID'].' ORDER BY `t_id` DESC LIMIT 0 , 10');

    //         $this->load->view('front/client_area/member/load_money', $data);
    //         $this->load->view('front/client_area/footer', $data);
    //     }else{
    //         redirect("member_form/login/");
    //     }

    // }



    // public function load_money_success()
    // {

    //     if ($this->m_logged_in == true) {
    //         // Receiving transection data from Perfect Money/PM
    //         $payee_account = $this->input->post('PAYEE_ACCOUNT');
    //         $payment_amount = $this->input->post('PAYMENT_AMOUNT');
    //         $payment_units = $this->input->post('PAYMENT_UNITS');
    //         $payment_batch_num = $this->input->post('PAYMENT_BATCH_NUM');
    //         $payer_account = $this->input->post('PAYER_ACCOUNT');
    //         $payment_id = $this->input->post('PAYMENT_ID');
    //         //$data['order_num'] = $this->input->post('ORDER_NUM');
    //         $cust_num = $this->input->post('CUST_NUM');
    //         $ID = $this->session->userdata('user_id');
    //         $PM_ID = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_ID");
    //         $min_amount_load_PM = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_PM");


    //         if (($payment_batch_num != 0) && ($payee_account == $PM_ID) && ($payment_amount >= $min_amount_load_PM)) {
    //             // Increasing balance of loader
    //             $previous_bal_of_receiver = get_field_by_id_from_table('users', 'balance', 'ID', $ID);
    //             $new_balance_of_receiver = array(
    //                 'balance' => $previous_bal_of_receiver + $payment_amount
    //             );
    //             $this->db->where('ID', $ID);
    //             $this->db->update('users', $new_balance_of_receiver);


    //             // Added Transection history to history_transection_pm
    //             $pm_load_data = array(
    //                 'receiver_id' => $ID,
    //                 'payment_batch_num' => $payment_batch_num,
    //                 'payee_account' => $payee_account,
    //                 'amount' => $payment_amount,
    //                 'payment_units' => $payment_units,
    //                 'payer_account' => $payer_account,
    //                 'payment_id' => $payment_id,
    //                 'cust_num' => $cust_num,
    //                 'date' => date("Y-m-d h:i:s")
    //             );

    //             $this->db->insert('history_transection_pm', $pm_load_data);

    //             $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");
    //         }else {
    //             $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! Load did not success.</div>");
    //         }

    //         redirect("member/general/load_money/");
    //     }else{
    //         redirect("member_form/login/");
    //     }

    // }

    // public function load_money_canceled()
    // {
    //     $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! Load did not success.</div>");
    //     redirect("member/general/load_money/");
    // }


    // public function load_money_nagad_success()
    // {
    //     if ($this->m_logged_in == true) {
    //         // Receiving transection data from Perfect Money/PM
    //         $nagad_phone = $this->input->post('nagad_phone');
    //         $sender_phone = $this->input->post('sender_phone');
    //         $transection = $this->input->post('transection');
    //         $amount = $this->input->post('amount');
    //         $ID = $this->session->userdata('user_id');
    //         $min_amount_load_nagad = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_nagad");


    //         if ($amount >= $min_amount_load_nagad) {
    //             // Added Transection history to history_transection_pm
    //             $nagad_load_data = array(
    //                 'receiver_id' => $ID,
    //                 'nagad_number' => $nagad_phone,
    //                 'transection_num' => $transection,
    //                 'sender_phone' => $sender_phone,
    //                 'amount' => $amount,
    //                 'date' => date("Y-m-d h:i:s")
    //             );

    //             $this->db->insert('history_transection_nagad', $nagad_load_data);
    //             $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");
    //         }else {
    //             $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! Load did not success.</div>");
    //         }

    //         redirect("member/general/load_money/");
    //     }else{
    //         redirect("member_form/login/");
    //     }
    // }



    // public function withdraw_perfectmoney()
    // {

    //     if ($this->m_logged_in == true) {
    //         // Receiving transection data from Perfect Money/PM
    //         $payeeAccount = $this->input->post('pm_number');
    //         $amount = $this->input->post('amount');
    //         $ID = $this->session->userdata('user_id');
    //         $min_amount_load_PM = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_PM");
    //         $payerAccount = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_ID");
    //         $accountId = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_account_id");
    //         $accountPass = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_account_pass");
    //         $previous_bal_of_user = get_field_by_id_from_table('users', 'balance', 'ID', $ID);
    //         $PM_rest_balance = $this->pm_account_balance();

    //         if (($amount >= $min_amount_load_PM) && ($amount <= $previous_bal_of_user) && ($amount <= $PM_rest_balance)) {

    //             // Discreasing balance of the user
    //             $new_balance_of_user = array(
    //                 'balance' => $previous_bal_of_user - $amount
    //             );
    //             $this->db->where('ID', $ID);
    //             $this->db->update('users', $new_balance_of_user);


    //             // Added Transection history to history_withdraw_pm
    //             $pm_withdraw_data = array(
    //                 'receiver_id' => $ID,
    //                 'payee_account' => $payeeAccount,
    //                 'amount' => $amount,
    //                 'payment_units' => 'USD',
    //                 'payer_account' => $payerAccount,
    //                 'date' => date("Y-m-d h:i:s")
    //             );

    //             $this->db->insert('history_withdraw_pm', $pm_withdraw_data);

    //             $withdrawId = $this->db->insert_id();

                
    //             // This script demonstrates transfer proccess between two
    //             // PerfectMoney accounts using PerfectMoney API interface.
                

    //             // trying to open URL to process PerfectMoney Spend Request
    //             $f = fopen('https://perfectmoney.is/acct/confirm.asp?AccountID=' . $accountId . '&PassPhrase=' . $accountPass . '&Payer_Account=' . $payerAccount . '&Payee_Account=' . $payeeAccount . '&Amount=' . $amount . '&PAY_IN=' . $amount . '&PAYMENT_ID=' . $withdrawId, 'rb');

    //             if ($f === false) {
    //                 //echo 'error openning url';
    //                 // Change status to history_withdraw_pm
    //                 $pm_withdraw_data = array(
    //                     'status' => 'Pending'
    //                 );
    //                 $this->db->where('history_withdraw_pm_id', $withdrawId);
    //                 $this->db->update('history_withdraw_pm', $pm_withdraw_data);
    //             }




    //             $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");

                 
    //         }else {
    //             $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! Withdraw did not success.</div>");
                 
    //         }

    //         redirect("member/general/withdraw/");

    //     }else{
    //         redirect("member_form/login/");
    //     }

    // }



    private function pm_account_balance(){
        $payerAccount = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_ID");
        $accountId = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_account_id");
        $accountPass = get_field_by_id_from_table('global_settings', 'value', 'title', "PM_account_pass");

        $f=fopen('https://perfectmoney.is/acct/balance.asp?AccountID='.$accountId.'&PassPhrase='.$accountPass, 'rb');

        if($f===false){
            echo 'error openning url';
        }

// getting data
        $out=array(); $out="";
        while(!feof($f)) $out.=fgets($f);

        fclose($f);

// searching for hidden fields
        if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
            echo 'Ivalid output';
            exit;
        }

// putting data to array
        $ar="";
        foreach($result as $item){
            $key=$item[1];
            $ar[$key]=$item[2];
        }

        //echo '<pre>';
        //print_r($ar);
        //echo '</pre>';
        return $ar[$payerAccount];
    }



    // Some unnecessary Code
//// getting data
//        $out=array(); $out="";
//        while(!feof($f)) $out.=fgets($f);
//
//        print $out;
//        fclose($f);
//
//// searching for hidden fields
//        if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
//            echo 'Ivalid output';
//            exit;
//        }
//
//        $ar="";
//        foreach($result as $item){
//            $key=$item[1];
//            $ar[$key]=$item[2];
//        }
//
//        echo '<pre>';
//        print_r($ar);
//        echo '</pre>';



    public function transfer_money($user_id=0)
    {

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


            $data['query'] = $this->db->query('SELECT * FROM `Tree` WHERE `ref_id`= '.$data['ID'].' ORDER BY `t_id` DESC LIMIT 0 , 10');

            $this->load->view('front/client_area/member/transfer_money', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }


    public function transfer_history()
    {

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
            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
            $this->load->view('front/client_area/header', $data);



            $this->db->where("sender_id", $data['ID']);
            $data['sending_history'] = $this->db->get('history_transection')->result();

            $this->db->where("receiver_id", $data['ID']);
            $data['receiving_history'] = $this->db->get('history_transection')->result();


            $this->load->view('front/client_area/member/transfer_history', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }
    }


    public function transfer_money_action()
    {
        $sender_id = $this->session->userdata('user_id');
        $receiver_id = get_ID_by_username($this->input->post('transfer_id'));
        $amount = $this->input->post('amount');
        $previous_bal_of_sender = get_field_by_id_from_table('users', 'balance', 'ID', $sender_id);
        $status_sender = get_field_by_id_from_table('users', 'status', 'ID', $sender_id);

        if ($status_sender == "Active") {
            if ($previous_bal_of_sender >= $amount) {
                if ($amount > 17) {
                    // Deducting balance of sender
                    $new_balance_of_serder = array(
                        'balance' => $previous_bal_of_sender - $amount
                    );
                    $this->db->where('ID', $sender_id);
                    $this->db->update('users', $new_balance_of_serder);


                    // Increasing balance of receiver
                    $previous_bal_of_receiver = get_field_by_id_from_table('users', 'balance', 'ID', $receiver_id);
                    $new_balance_of_receiver = array(
                        'balance' => $previous_bal_of_receiver + $amount
                    );
                    $this->db->where('ID', $receiver_id);
                    $this->db->update('users', $new_balance_of_receiver);



                    // Insert into Transection Histroy Table
                    $transection_history = array(
                        'sender_id' => $sender_id,
                        'receiver_id' => $receiver_id,
                        'purpose' => "Money Transection ".date("Y-m-d h:i:s A"),
                        'amount' => $amount,
                        'date' => date("Y-m-d h:i:s")
                    );
                    $this->db->insert('history_transection', $transection_history);


                    $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");
                } else {
                    $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Please input minimum $5</div>");
                }
            } else {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>You do not have enough balance to transfer.</div>");
            }
        }else{
            $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Your account is inactive. You can not transfer balance.</div>");
        }

        redirect("member/general/transfer_money/");
    }




    public function matching_report($user_id=0)
    {

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


            $data['querya'] = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = ".$data['ID']);
            $data['com_taken_matching'] = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = ".$data['ID'])->num_rows();
            $data['total_matching_amount'] = $this->db->query("SELECT SUM(amount) FROM `comm_matching` WHERE `u_id` = ".$data['ID'])->result_array();


            $this->load->view('front/client_area/member/matching_report', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }


    public function change_status(){
        $userID = $this->session->userdata('user_id');
        $oldstatus = get_field_by_id_from_table('users', 'status', 'ID', $userID);
        $previous_bal = get_field_by_id_from_table('users', 'balance', 'ID', $userID);
        $active_amount = get_field_by_id_from_table("global_settings", "value", "title", "active_amount");

        if ($oldstatus != "Active") {
            // Deducting balance And account change status
            if ($previous_bal >= $active_amount) {





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
//                            if ($lpoint > $rpoint) {
//                                $next_com_times = floor($lpoint / $min_matching_point);
//                            } else {
//                                $next_com_times = floor($rpoint / $min_matching_point);
//                            }
//                            $matching_com = $next_com_times * $matching_commission;
//                            $next_com = $existing_com + $matching_com;


                            // Updating commission on user table
                            $data = array(
                                'commission' => $existing_com + $matching_commission
                            );
                            $this->db->where('ID', $parent_id);
                            $this->db->update('users', $data);


                            //Inserting into matching commission table
                            //for ($i = 1; $i <= $next_com_times; $i++) {
                            $matching_commission;
                                $data = array(
                                    'u_id' => $parent_id,
                                    'purpose' => 'Matching Commission'.date("Y-m-d h:i:s A"),
                                    'amount' => $matching_commission,
                                    'date' => date("Y-m-d h:i:s")
                                );
                                $this->db->insert('comm_matching', $data);
                            //}


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

                        // if both side gets 0 after completing the limitation, No Point will be generated at that day.
//                        if (($old_lpoint == 0) && ($old_rpoint == 0)){
//                            $flash_hand = $point_hand;
//                        }


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


//                        if ($lpoint <> $rpoint) {
//                            if ($lpoint > $rpoint) {
//                                $flash_hand = "rpoint";
//                            } else {
//                                $flash_hand = "lpoint";
//                            }
//                        }else {
//                            $flash_hand = $point_hand;
//                        }




                    }


                    $user_id = $parent_id;
                    $parent_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $parent_id);
                }



                // Change status of to Active and deduct balance
                $new_balance = array(
                    'balance' => $previous_bal - $active_amount,
                    'status' => "Active"
                );
                $this->db->where('ID', $userID);
                $this->db->update('users', $new_balance);

                $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success! Your account is active.".$com_taken_on_day.".$per_day_matching.".$flash_hand."</div>");
            } else {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Not Enough Balance. Please load balance.</div>");
            }
        }else{
            $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Already Activated.</div>");
        }

        redirect("member/general/dashboard/");
    }






}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
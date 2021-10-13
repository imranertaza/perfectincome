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


            $data['query'] = $this->db->query('SELECT * FROM `Tree` WHERE `ref_id`= '.$data['ID'].' ORDER BY `t_id` DESC LIMIT 0 , 10');

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




    public function load_money($user_id=0)
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

            $this->load->view('front/client_area/member/load_money', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }

    }





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


    public function transfer_money_action()
    {
        $sender_id = $this->session->userdata('user_id');
        $receiver_id = get_ID_by_username($this->input->post('transfer_id'));
        $amount = $this->input->post('amount');
        $previous_bal_of_sender = get_field_by_id_from_table('users', 'balance', 'ID', $sender_id);

        if($previous_bal_of_sender >= $amount) {
            if ($amount > 4) {

            $this->db->trans_start();
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
                
            $this->db->trans_complete();

                $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");
            } else {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Please input minimum $5</div>");
            }
        }else {
            $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>You do not have enough balance to transfer.</div>");
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
                );
                $this->db->insert('comm_spot', $spon_commision_statement);


                //All Users Perent_point will be increased And matching
                $min_matching_point = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");
                $per_day_matching = get_field_by_id_from_table("global_settings", "value", "title", "per_day_matching");
                $matching_commission = get_field_by_id_from_table("global_settings", "value", "title", "matching_commission");

                $parent_id = get_field_by_id_from_table("Tree", "pr_id", "u_id", $userID);
                $user_id = $userID;
                while (!empty($parent_id)) {


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


                    //Matching Commission
                    $com_taken_on_day = $this->db->query("SELECT * FROM `comm_matching` WHERE `u_id` = $parent_id AND `date` BETWEEN '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59'")->num_rows();
                    if ($com_taken_on_day < $per_day_matching) {


                        $lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                        $rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);


                        if (($lpoint >= $min_matching_point) && ($rpoint >= $min_matching_point) && !empty($hand->l_t) && !empty($hand->r_t)) {

                            $existing_com = get_field_by_id_from_table("users", "commission", "ID", $parent_id);
                            if ($lpoint > $rpoint) {
                                $next_com_times = floor($lpoint / $min_matching_point);
                            } else {
                                $next_com_times = floor($rpoint / $min_matching_point);
                            }
                            $matching_com = $next_com_times * $matching_commission;
                            $next_com = $existing_com + $matching_com;


                            // Updating commission on user table
                            $data = array(
                                'commission' => $next_com
                            );
                            $this->db->where('ID', $parent_id);
                            $this->db->update('users', $data);


                            //Inserting into matching commission table
                            for ($i = 1; $i <= $next_com_times; $i++) {
                                $data = array(
                                    'u_id' => $parent_id,
                                    'purpose' => 'Matching Commission',
                                    'amount' => $matching_commission
                                );
                                $this->db->insert('comm_matching', $data);
                            }


                            //Decreasing Left Point
                            $matching_point = $next_com_times * $min_matching_point;
                            $left_data = array(
                                'lpoint' => $lpoint - $matching_point,
                                'rpoint' => $rpoint - $matching_point
                            );
                            $this->db->where('ID', $parent_id);
                            $this->db->update('users', $left_data);


                            // Flash existing Point after 25
                            if ($com_taken_on_day == $per_day_matching) {
                                if ($lpoint > $rpoint) {
                                    $flash_hand = "rpoint";
                                } else {
                                    $flash_hand = "lpoint";
                                }
                                $flashdata = array(
                                    $flash_hand => 0
                                );
                                $this->db->where('ID', $parent_id);
                                $this->db->update('users', $flashdata);
                            }

                        }

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

                $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success! Your account is active.</div>");
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
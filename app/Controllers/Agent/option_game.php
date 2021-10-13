<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class option_game extends CI_Controller {


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




	public function index($user_id=0)
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
            $data['gameBalance'] = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $data['ID']);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
            $data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
            $data['user_id'] = $user_id;


            // Game information
            $gameId = 1;
            $data['gameInfo'] = $this->db->get_where('pins', array("user_id" => $gameId))->row();

            //Getting joined list
            $this->db->select("option_id");
            $this->db->group_by("option_id");
            $data['optionTakenList'] = $this->db->get_where('op_game_participate', array("game_id" => $gameId, "user_id" => $data['ID']))->result();
            //print $this->db->last_query();


            if($data['role'] != 4) {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>You don't have permission on that page..</div>");
                redirect("agent/general/dashboard/");
                die();
            }

            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
            $this->load->view('front/client_area/header', $data);

            $query = $this->db->get_where('users', array('ID'=>$data['ID']));
            $data['row'] = $query->row();

            //$data['query'] = $this->db->query('SELECT * FROM `Tree` WHERE `ref_id`= '.$data['ID'].' ORDER BY `t_id` DESC LIMIT 0 , 10');
            $data['options'] = $this->db->get_where("options", array("game_id" => "1"))->result();

            $this->load->view('front/client_area/agent/option_game', $data);
            $this->load->view('front/client_area/footer', $data);
        }else{
            redirect("member_form/login/");
        }
		
	}

	public function option_game_action(){
        $option = $this->input->post('option');
        $amount = $this->input->post('amount');
        $gameId = $this->input->post('gameId');
        $userID = $this->session->userdata('user_id');
        $previous_bal = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $userID);
        $gameStatus = get_field_by_id_from_table('option_game', 'status', 'game_id', $gameId);


        if ($previous_bal >= $amount) {
            if ($gameStatus == "Active") {

            $this->db->trans_start();
                // Deducting balance of user
                $new_balance = array(
                    'OP_game_balance' => $previous_bal - $amount
                );
                $this->db->where('ID', $userID);
                $this->db->update('users', $new_balance);


                // Insert into op_game_participate
                $participate = array(
                    'user_id' => $userID,
                    'game_id' => $gameId,
                    'option_id' => $option,
                    'amount' => $amount,
                    'date' => date("Y-m-d h:i:s")
                );
                $this->db->insert('op_game_participate', $participate);


                // Insert into history_op_game_participate
                $history_participate = array(
                    'user_id' => $userID,
                    'game_id' => $gameId,
                    'option_id' => $option,
                    'amount' => $amount,
                    'date' => date("Y-m-d h:i:s")
                );
                $this->db->insert('history_op_game_participate', $history_participate);
                $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");
            $this->db->trans_complete();

            }else {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! no more bid in this game.</div>");
            }
        }else {
            $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! You don't have sufficient balance to play.</div>");
        }

        redirect("agent/option_game/");

    }




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
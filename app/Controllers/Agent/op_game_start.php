<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class op_game_start extends CI_Controller {


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



    public function index()
    {
        $winInfo = (object) $this->winInfo();
        //print $winInfo->winOptionAmount = 2;
        //print $winnerOption = ($winOption == 0) ? $winInfo->winOption : $winOption;
        if ($winInfo->winOptionAmount > 0) {
            //$winInfo->winOption = 2;
            //$winIds = $this->participateList($winInfo->winOption);
            $winIds = $this->participateList($winInfo->winOption);
            //print_r($winIds);
            foreach ($winIds as $winId) {
                print $winId;
                print $totalAmountTaken = $this->totalTakenInOption($winId, $winInfo->winOption);

                //Winning amount
                $winningAmount = $totalAmountTaken*85;


                //Add the winning amount to game balance
                $this->updateWinningUserBalance($winId, $winningAmount);


                //Add winning history to history_op_game_win
                $winninHistory = array(
                    'user_id' => $winId,
                    'game_id' => 1,
                    'option_id' => $winInfo->winOption,
                    'amount_tkn' => $totalAmountTaken,
                    'amount_win' => $winningAmount,
                    'date' => date("Y-m-d h:i:s")
                );
                $this->db->insert('history_op_game_win', $winninHistory);

            }
        }else {
            //Add winning history to history_op_game_win
            $winninHistory = array(
                'user_id' => null,
                'game_id' => 1,
                'option_id' => $winInfo->winOption,
                'amount_tkn' => null,
                'amount_win' => null,
                'date' => date("Y-m-d h:i:s")
            );
            $this->db->insert('history_op_game_win', $winninHistory);
        }



        //Adding Commission to Agent Account
        $participateList = $this->totalParticipateList();
        foreach ($participateList as $participant) {
            $totalAmountTakenToAllOptions = $this->totalAmountTakenToAllOptions($participant);

            //Commission Amount
            $commission = ($totalAmountTakenToAllOptions*10)/100;

            //Update Commission of users
            $this->updateUserCommision($participant, $commission);

            //Add winning history to history_op_game_comm
            $commissionHistory = array(
                'user_id' => $participant,
                'game_id' => 1,
                'commission' => $commission,
                'date' => date("Y-m-d h:i:s")
            );
            $this->db->insert('history_op_game_comm', $commissionHistory);

        }


        //Trancate op_game_participate for the new game
        $this->db->truncate('op_game_participate');

        //change game status to Active Again.
        $status = array(
            'status' => "Active"
        );
        $this->db->where('game_id', 1);
        $this->db->update('option_game', $status);

    }




    public function setWinOPtion($winOption=0)
    {
        $winInfo = (object) $this->winInfoSelectedOption($winOption);
        //print $winInfo->winOptionAmount = 2;
        //print $winnerOption = ($winOption == 0) ? $winInfo->winOption : $winOption;
        if ($winInfo->winOptionAmount > 0) {
            //$winInfo->winOption = 2;
            //$winIds = $this->participateList($winInfo->winOption);
            $winIds = $this->participateList($winInfo->winOption);
            //print_r($winIds);
            foreach ($winIds as $winId) {
                //print $winId;
                $totalAmountTaken = $this->totalTakenInOption($winId, $winInfo->winOption);

                //Winning amount
                $winningAmount = $totalAmountTaken*85;


                //Add the winning amount to game balance
                $this->updateWinningUserBalance($winId, $winningAmount);


                //Add winning history to history_op_game_win
                $winninHistory = array(
                    'user_id' => $winId,
                    'game_id' => 1,
                    'option_id' => $winInfo->winOption,
                    'amount_tkn' => $totalAmountTaken,
                    'amount_win' => $winningAmount,
                    'date' => date("Y-m-d h:i:s")
                );
                $this->db->insert('history_op_game_win', $winninHistory);

            }
        }else {
            //Add winning history to history_op_game_win
            $winninHistory = array(
                'user_id' => null,
                'game_id' => 1,
                'option_id' => $winInfo->winOption,
                'amount_tkn' => null,
                'amount_win' => null,
                'date' => date("Y-m-d h:i:s")
            );
            $this->db->insert('history_op_game_win', $winninHistory);
        }



        //Adding Commission to Agent Account
        $participateList = $this->totalParticipateList();
        foreach ($participateList as $participant) {
            $totalAmountTakenToAllOptions = $this->totalAmountTakenToAllOptions($participant);

            //Commission Amount
            $commission = ($totalAmountTakenToAllOptions*10)/100;

            //Update Commission of users
            $this->updateUserCommision($participant, $commission);

            //Add winning history to history_op_game_comm
            $commissionHistory = array(
                'user_id' => $participant,
                'game_id' => 1,
                'commission' => $commission,
                'date' => date("Y-m-d h:i:s")
            );
            $this->db->insert('history_op_game_comm', $commissionHistory);

        }


        //Trancate op_game_participate for the new game
        $this->db->truncate('op_game_participate');

        //change game status to Active Again.
        $status = array(
            'status' => "Active"
        );
        $this->db->where('game_id', 1);
        $this->db->update('option_game', $status);


        print "Success";

    }




    public function create_options($number, $gameId)
    {

        //Trancate options table
        $this->db->truncate('options');

        for ($i=1; $i<=$number; $i++) {
            //Add options to the game
            $options = array(
                'option_name' => "Option ".$i,
                'game_id' => $gameId,
                'created_time' => date("Y-m-d h:i:s")
            );
            $this->db->insert('options', $options);

        }

    }



    public function stopbiding(){
	    $gameId = 1;
        $changestatus = array(
            'status' => "Stop"
        );
        $this->db->where('game_id', $gameId);
        $this->db->update('option_game', $changestatus);

        print "Success";
    }








    private function totalParticipateList()
    {
        $participateList = array();
        $this->db->group_by("user_id");
        $query = $this->db->get_where("op_game_participate", array("game_id" => 1))->result();
        foreach ($query as $row) {
            $participateList[] = $row->user_id;
        }
        return $participateList;
    }

    public function totalAmountTakenToAllOptions($userId) {
        $this->db->select_sum("amount");
        $query = $this->db->get_where("op_game_participate", array("user_id" => $userId, "game_id" => 1))->row();
        //print $this->db->last_query();
        return $totalTaken = $query->amount;
    }


    private function updateWinningUserBalance($userId, $AmountToAdd){
        $previous_bal = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $userId);
        $new_balance = array(
            'OP_game_balance' => $previous_bal + $AmountToAdd
        );
        $this->db->where('ID', $userId);
        $this->db->update('users', $new_balance);
    }


    private function updateUserCommision($userId, $AmountToAdd){
        $previous_com = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $userId);
        $new_commission = array(
            'OP_game_balance' => $previous_com + $AmountToAdd
        );
        $this->db->where('ID', $userId);
        $this->db->update('users', $new_commission);
    }


	private function winInfo()
	{
        $lowest_amount = NULL;
	    $all_options = $this->db->get("options")->result();
	    foreach($all_options as $option){
	        $this->db->select_sum("amount");
	        $query = $this->db->get_where("op_game_participate", array("option_id" => $option->option_id, "game_id" => 1))->row();
	        $sum = empty($query->amount) ? 0 : $query->amount;

            if($lowest_amount === NULL) {
                $lowest_amount = $sum;
                $lowest_option = $option->option_id;
            }else {
                if($sum < $lowest_amount) {
                    $lowest_amount = $sum;
                    $lowest_option = $option->option_id;
                }
            }
        }

	    $winInfo = array("winOption" => $lowest_option, "winOptionAmount" => $lowest_amount);
	    //print_r($winInfo);
        return $winInfo;
	}



    private function winInfoSelectedOption($optionId)
    {

            $this->db->select_sum("amount");
            $query = $this->db->get_where("op_game_participate", array("option_id" => $optionId, "game_id" => 1))->row();
            $sum = empty($query->amount) ? 0 : $query->amount;
            $amount = $sum;
            $win_option = $optionId;

        $winInfo = array("winOption" => $win_option, "winOptionAmount" => $amount);
        //print_r($winInfo);
        return $winInfo;
    }



    private function participateList($optionId)
    {
        $winIds = array();
        $this->db->group_by("user_id");
        $query = $this->db->get_where("op_game_participate", array("option_id" => $optionId, "game_id" => 1))->result();
        foreach ($query as $row) {
            $winIds[] = $row->user_id;
        }
        return $winIds;
    }


    private function totalTakenInOption($userId, $optionId)
    {
        $this->db->select_sum("amount");
        $query = $this->db->get_where("op_game_participate", array("option_id" => $optionId, "user_id" => $userId, "game_id" => 1))->row();
        return $query->amount;
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
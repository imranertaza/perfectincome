<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class balance_history extends CI_Controller {

    private $login_status;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('users/user_login');
        $this->load->model('functions');
        $this->load->helper('settings_functions_helper');

        if ($this->session->userdata('logged_in') == true) {
            $this->login_status = true;
        }else {
            $this->login_status = false;
        }
    }

    public function index()
    {


        if ($this->login_status == true) {
            $this->load->helper('settings_functions_helper');
            $this->load->model('functions');

            $this->load->helper('url');
            $this->load->view('admin/header');
            $this->load->view('admin/sidebar');
            if ($this->functions->hasPermission('download_list') == true) {

                //user list
                $this->db->select("*");
                $data['records'] = $this->db->get_where("users", array("type" => 2))->result();

                $this->load->view('admin/Request/agent_balance_list', $data);
            } else {
                $this->load->view('admin/no_permission');
            }
            $this->load->view('admin/footer');

        } else {
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->load->view('admin/login');
        }
    }



    public function balance_update_action(){

        $user_name = $this->input->post('username');
        $balance = $this->input->post('balance');

        $adminBalance = get_field_by_id_from_table('users', 'balance', 'ID', 1);
        $totalAdminBalance = $adminBalance - $balance;

        if ($adminBalance >= $balance) {
        
        $this->db->trans_start();
        //Insert
            $sendarID = $this->session->userdata('user_id');
            $receiverId = get_userid_by_username($user_name);

            $data = array(
                'sender_id' => $sendarID, 
                'receiver_id' => $receiverId,
                'purpose' => 'Get Balance Frome Admin',
                'amount' => $balance,                
            );

            $insert = $this->db->insert('history_transection', $data);
        //Update Balance
            update_balance($user_name,$balance);
        //Update Admin Balance
            $admindata = array(
                'balance' => $totalAdminBalance,               
            );
            $this->db->where('ID', 1);
            $this->db->update('users', $admindata);

        $this->db->trans_complete();
        
            $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Your payment complete..</div>");
            redirect("Admin_ut/balance_history/");
        }
        else{
           $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>You do not have enough balance for this payment..</div>");
           redirect("Admin_ut/balance_history/");
        }

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class deposit_request extends CI_Controller {

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

//	public function index(){
//	    redirect("member/general/dashboard/");
//    }





    public function index()
    {


        if ($this->login_status == true) {
            $this->load->helper('settings_functions_helper');
            $this->load->model('functions');

            $this->load->helper('url');
            $this->load->view('admin/header');
            $this->load->view('admin/sidebar');
            if ($this->functions->hasPermission('download_list') == true) {

                //query nagad transection list for this user
                $this->db->select("*");
                $data['records'] = $this->db->get("history_transection_nagad")->result();

                $this->load->view('admin/Request/deposit_request_list', $data);
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



    public function change_status($status, $his_trans_nagad_ID)
    {

        if ($this->login_status == true) {
            if ($this->functions->hasPermission('download_list') == true) {
                if ($status == 1) {

                    $doller_rate = get_field_by_id_from_table('global_settings', 'value', 'title', "doller_rate");
                    $userID = get_field_by_id_from_table('history_transection_nagad', 'receiver_id', 'history_trans_nagad_id', $his_trans_nagad_ID);
                    $amount = get_field_by_id_from_table('history_transection_nagad', 'amount', 'history_trans_nagad_id', $his_trans_nagad_ID);
                    $payment_amount = $amount / $doller_rate;


                    //Update Status and set it as Approved
                    $statusData = array(
                        'status' => "Approved"
                    );
                    $this->db->where('history_trans_nagad_id', $his_trans_nagad_ID);
                    $this->db->update('history_transection_nagad', $statusData);


                    // Increasing balance of loader
                    $previous_bal_of_receiver = get_field_by_id_from_table('users', 'balance', 'ID', $userID);
                    $statusData = array(
                        'balance' => $previous_bal_of_receiver + $payment_amount
                    );
                    $this->db->where('ID', $userID);
                    $this->db->update('users', $statusData);

                } else {
                    //Update Status and set it as Cancel
                    $new_balance_of_receiver = array(
                        'status' => "Canceled"
                    );
                    $this->db->where('history_trans_nagad_id', $his_trans_nagad_ID);
                    $this->db->update('history_transection_nagad', $new_balance_of_receiver);
                }

            }

            redirect("Admin_ut/deposit_request");


        } else {
//            $this->load->helper('url');
//            $this->load->library('form_validation');
//            $this->load->view('admin/login');
            redirect("admin/login");
        }
    }




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdraw_request extends CI_Controller {

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

                //$data['min_amount_load_nagad'] = get_field_by_id_from_table('global_settings', 'value', 'title', "min_amount_load_nagad");
                //$data['doller_rate'] = get_field_by_id_from_table('global_settings', 'value', 'title', "doller_rate");

                //query nagad transection list for this user
                $this->db->select("*");
                $data['records'] = $this->db->get("history_withdraw_nagad")->result();

                $this->load->view('admin/Request/withdraw_request_list', $data);
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



    public function change_status($status, $his_wtd_nagad_ID)
    {

        if ($this->login_status == true) {
            if ($this->functions->hasPermission('download_list') == true) {
                if ($status == 1) {


                    $sender_phone = $this->input->post('sender_phone');
                    $trans_num = $this->input->post('trans_num');


                    //Update Status and set it as Approved
                    $statusData = array(
                        'status' => "Approved",
                        'sender_phone' => $sender_phone,
                        'transection_num' => $trans_num
                    );
                    $this->db->where('history_withdraw_nagad_id', $his_wtd_nagad_ID);
                    $this->db->update('history_withdraw_nagad', $statusData);

                } else {
                    //Update Status and set it as Cancel
                    $statusData = array(
                        'status' => "Canceled"
                    );
                    $this->db->where('history_withdraw_nagad_id', $his_wtd_nagad_ID);
                    $this->db->update('history_withdraw_nagad', $statusData);
                }

            }

            redirect("Admin_ut/withdraw_request/");


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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class point_history extends CI_Controller {

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



                $username = $this->input->post('username');
                $u_id = get_ID_by_username($username);

                $type = $this->input->post('type');

                //query nagad transection list for this user
                $data['balance'] = number_format(get_balance_by_id($u_id) ,2);
                $data['commission'] = number_format(get_commission_by_id($u_id), 2);
                $this->db->select("*");
                if ($type) {
                    $data['records'] = $this->db->get_where("history_point", array("u_id" => $u_id, "type" => $type))->result();
                }else {
                    $data['records'] = $this->db->get_where("history_point", array("u_id" => $u_id))->result();
                }

                $data['totalLeftAdd'] = $this->db->get_where("history_point", array("u_id" => $u_id, "lpoint !=" => "Null", "type" => "Add"))->num_rows();
                $data['totalRightAdd'] = $this->db->get_where("history_point", array("u_id" => $u_id, "rpoint !=" => "Null", "type" => "Add"))->num_rows();

                $data['totalDeduct'] = $this->db->get_where("history_point", array("u_id" => $u_id, "type" => "Deduct"))->num_rows();

                $data['totalLeftFlush'] = $this->db->get_where("history_point", array("u_id" => $u_id, "lpoint" => "100", "type" => "Flush"))->num_rows();
                $data['totalRightFlush'] = $this->db->get_where("history_point", array("u_id" => $u_id, "rpoint" => "100", "type" => "Flush"))->num_rows();
                //print $this->db->last_query();


                $this->load->view('admin/Point/list', $data);
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
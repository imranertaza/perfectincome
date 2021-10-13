<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');
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


		$home_page_query = $this->db->query("SELECT * FROM `pages` where `page_id` = '100'");
		$h_page_query = $home_page_query->row();
		$data['title'] = $h_page_query->page_title;
		$data['description'] = $h_page_query->page_description;
		

		$latest_notice = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC");
		$last_notice = $latest_notice->row();
		$data['notice_title'] = $last_notice->title;
		$data['notice_description'] = $last_notice->description;
		$data['notice_file'] = $last_notice->file;
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
		
		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
			 $data['list_slider'] = 'No Slider Added';	
		}
		$data['slider'] = $this->load->view('front/slider', $data, true);
		
		$data['page_title'] = 'home';
		$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
		

		if ($this->m_logged_in == true) {
            redirect("member/dashboard/");
		}else{
			$data['check_user'] = '';
			$data['log_url'] = 'member_form/login';
			$data['log_title'] = 'Login';
			$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
			$this->load->view('front/header', $data);
			$this->load->view('front/page', $data);
			$this->load->view('front/footer', $data);
		}
		
		
	}




    public function accumulate_commission()
    {
        $all_users = $this->db->get("users")->result();
        foreach($all_users as $user){
            $user_commission = $user->commission;
            $current_balance = $user->balance;

            //Update balance
            $balance = array(
                'balance' => $current_balance + $user_commission,
                'commission' => 0
            );
            $this->db->where("ID", $user->ID);
            $this->db->update("users", $balance);
        }

    }


    public function ads_view_income()
    {
        $this->db->where("status", "Active");
        $all_users = $this->db->get("users")->result();
        foreach($all_users as $user){
            $current_balance = $user->balance;

            //Update balance
            $balance = array(
                'balance' => $current_balance + 0.70
            );
            $this->db->where("ID", $user->ID);
            $this->db->update("users", $balance);

            //Insert into the history_ads_views table
            $earn_taken_on_day = $this->db->query("SELECT * FROM `history_ads_views` WHERE `u_id` = $user->ID AND `date` BETWEEN '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59'")->num_rows();
            if ($earn_taken_on_day < 5) {
                for ($i = 1; $i <= 5; $i++) {
                    $statement = array(
                        'u_id' => $user->ID,
                        'purpose' => "Ad View of the day: " . date("d M Y h:i:s A"),
                        'amount' => 0.14,
                        'date' => date("Y-m-d h:i:s")
                    );
                    $this->db->insert("history_ads_views", $statement);
                }
            }
        }

    }


	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

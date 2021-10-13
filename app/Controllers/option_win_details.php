<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class option_win_details extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('users/user_login');
		$this->load->helper('settings_functions_helper');
		
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}
	}
	

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('student_functions_helper');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');
		$this->load->library('pagination');
		
		$notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($notice_list->num_rows() > 0)
		{
		   $data['list_notice'] = $notice_list->result();
		}else {
			$data['list_notice'] = 'No notice published';	
		}


		$data['dwn_path'] = base_url()."uploads/downloads/";
		
		$data['timthumb'] = "assets/timthumb.php";
		$data['pro_path'] = "uploads/pro_image/";
		$data['web_page_title'] = "Product List";

		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);
		$data['page_title'] = 'Product List';
		
		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
			 $data['list_slider'] = 'No Slider Added';	
		}
		$data['slider'] = $this->load->view('front/slider', $data, true);

        $data['check_user'] = '';
        $data['log_url'] = 'member_form/login.html';
        $data['log_title'] = 'Login';
        $data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
        $this->load->view('front/header', $data);
        $this->load->view('front/option_win_details', $data);
        $this->load->view('front/footer', $data);


	}
	


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

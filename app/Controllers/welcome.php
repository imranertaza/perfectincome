<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class welcome extends CI_Controller {
	
	public function index()
	{
        $this->load->helper('settings_functions_helper');
        $this->load->helper('path');
        $this->load->library('pagination');
        $this->load->model('settings/global_settings');
        $this->load->model('functions');



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


        $this->load->view('welcome_message');
		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

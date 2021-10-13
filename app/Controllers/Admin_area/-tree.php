<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tree extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('file');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('users/user_login');
		
		if ($this->session->userdata('logged_in') == true) {
			$this->login_status = true;
		}else {
			$this->login_status = false;
		}
	}
	

	public function index($user_id=0)
	{
		$data['user_id'] = $user_id;
		$data['ID'] = $this->session->userdata('user_id');
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->helper('student_functions_helper');
			if ($this->functions->hasPermission('page_list') == true) {
			
			$this->load->view('admin/Tree/view_tree', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
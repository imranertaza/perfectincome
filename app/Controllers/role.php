<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class role extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->model('users/user_login');
		
		if ($this->session->userdata('logged_in') == true) {
			$this->login_status = true;
		}else {
			$this->login_status = false;
		}
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function users_role_list()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('user_role_list') == true) {
			$this->load->model('users/role_add_list');
			$this->load->view('admin/role/users_role_list');
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function add_role()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_role') == true) {
			$this->load->model('functions');
			$this->load->model('users/role_add_list');
			$this->load->view('admin/role/add_user_role');
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
			
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function edit_role($role_id)
	{
		$data['role_id'] = $role_id;
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_role') == true) {
			$this->load->model('functions');
			$this->load->model('users/role_add_list');
			$this->load->view('admin/role/edit_user_role', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function access_permission()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('permission_list') == true) {
			$this->load->model('functions');
			$this->load->model('users/role_add_list');
			$this->load->view('admin/role/access_permission');
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
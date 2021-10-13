<?php
class category extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		//$this->load->model('user_login');
		
		if ($this->session->userdata('logged_in') == true) {
			$this->login_status = true;
		}else {
			$this->login_status = false;
		}
	}

	public function add_category()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$this->load->model('Category/categoryModel');
				$this->load->view('admin/Category/add_category');
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
	
	
	
	public function category_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('category_list') == true) {
				$this->load->model('Category/categoryModel');
				$this->load->view('admin/Category/category_list');
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
	
	
	public function edit_category($cat_id)
	{
		$data['cat_id'] = $cat_id;
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('category_list') == true) {
				$this->load->model('Category/categoryModel');
				$this->load->view('admin/Category/edit_category', $data);
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


?>
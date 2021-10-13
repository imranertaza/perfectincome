<?php
class location extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		//$this->load->model('user_login');
		$this->load->library('form_validation');
		$this->load->helper('settings_functions_helper');
		if ($this->session->userdata('logged_in') == true) {
			$this->login_status = true;
		}else {
			$this->login_status = false;
		}
	}

	public function add_division()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				#$this->load->model('Location/categoryModel');
			
			$info['succes'] = '';	
			if (isset($_POST['add_division'])) {
				
				$this->form_validation->set_rules('div_name', 'Division', 'trim|required|xss_clean');
				
				if ($this->form_validation->run() == true) {
				$data = array(
							'name' => $_POST['div_name'],
							'type' => 'div'
							);
				$info['succes'] = $this->db->insert('Location', $data);
				}
				
			}
			
				
				$this->load->view('admin/Location/add_division', $info);
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
	
	
	
	
	public function list_division()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$data['list'] = $this->db->query("SELECT `per_id`,`name` FROM `Location` WHERE `type` = 'div'");
				$this->load->view('admin/Location/division_list', $data);
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
	
	
	
	
	
	public function add_district()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$info['succes'] = '';	
				if (isset($_POST['add_district'])) {
					
					$this->form_validation->set_rules('district_name', 'District', 'trim|required|xss_clean');
					$this->form_validation->set_rules('perent', 'Division', 'trim|required|is_natural_no_zero|xss_clean');
					$this->form_validation->set_message('is_natural_no_zero', 'Please select a division.');
					
					if ($this->form_validation->run() == true) {
					$data = array(
								'name' => $_POST['district_name'],
								'per_id' => $_POST['perent'],
								'type' => 'dis'
								);
					$info['succes'] = $this->db->insert('Location', $data);
					}
					
				}
				$this->load->view('admin/Location/add_district', $info);
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

	
	public function add_thana()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$info['succes'] = '';	
				if (isset($_POST['add_thana'])) {
					
					$this->form_validation->set_rules('thana', 'Thana/Upazilla', 'trim|required|xss_clean');
					$this->form_validation->set_rules('division', 'division', 'trim|required|is_natural_no_zero|xss_clean');
					$this->form_validation->set_message('is_natural_no_zero', 'Please select a division.');
					$this->form_validation->set_rules('perent', 'District', 'trim|required|is_natural_no_zero|xss_clean');
					$this->form_validation->set_message('is_natural_no_zero', 'Please select a district.');
					
					if ($this->form_validation->run() == true) {
					$data = array(
								'name' => $_POST['thana'],
								'per_id' => $_POST['perent'],
								'type' => 'tha'
								);
					$info['succes'] = $this->db->insert('Location', $data);
					}
					
				}
				$this->load->view('admin/Location/add_thana', $info);
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
	
	
	
	public function add_word()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$info['succes'] = '';	
				if (isset($_POST['add_ward'])) {
					
					$this->form_validation->set_rules('ward_name', 'Ward/Union', 'trim|required|xss_clean');
					$this->form_validation->set_rules('division', 'Division', 'trim|required|is_natural_no_zero|xss_clean');
					$this->form_validation->set_message('is_natural_no_zero', 'Please select a division.');
					$this->form_validation->set_rules('district', 'District', 'trim|required|is_natural_no_zero|xss_clean');
					$this->form_validation->set_message('is_natural_no_zero', 'Please select a district.');
					$this->form_validation->set_rules('perent', 'Thana', 'trim|required|is_natural_no_zero|xss_clean');
					$this->form_validation->set_message('is_natural_no_zero', 'Please select a thana.');
					
					if ($this->form_validation->run() == true) {
					$data = array(
								'name' => $_POST['ward_name'],
								'per_id' => $_POST['perent'],
								'type' => 'ward'
								);
					$info['succes'] = $this->db->insert('Location', $data);
					}
					
				}
				$this->load->view('admin/Location/add_word', $info);
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
	

	
	public function word_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$data['list'] = $this->db->query("SELECT `per_id`,`name` FROM `Location` WHERE `type` = 'ward'");
				$this->load->view('admin/Location/word_list', $data);
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
	

	
	public function thana_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$data['list'] = $this->db->query("SELECT `per_id`,`name` FROM `Location` WHERE `type` = 'tha'");
				$this->load->view('admin/Location/thana_list', $data);
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
	
	
	
	public function district_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				$data['list'] = $this->db->query("SELECT `per_id`,`name` FROM `Location` WHERE `type` = 'dis'");
				$this->load->view('admin/Location/district_list', $data);
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
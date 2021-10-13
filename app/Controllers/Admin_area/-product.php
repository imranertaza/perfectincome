<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller {
	
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
	

	public function listi($page_no=0)
	{
		
		if ($this->login_status == true) {
			$data['page_no'] = $page_no;
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('page_list') == true) {
			$this->load->model('product/product_function');
			$this->load->library('pagination');
			
			
			$name = isset($_POST['name']) ? $_POST['name'] : 0;
			if (!empty($name)) { $name_src = "`name` LIKE '%$name%'"; }else { $name_src = "1=1"; }
			
			$data['base_url'] = base_url().'admin_area/product/listi/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `products` WHERE $name_src ORDER BY `pro_id` DESC")->num_rows();
			$data['per_page'] = 7; 
			$data['uri_segment'] = 4;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(4);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$all_teacher = $this->db->query("SELECT * FROM `products` WHERE $name_src ORDER BY `pro_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $all_teacher->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('admin/product/list', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function add()
	{	
		if ($this->login_status == true) {
			$this->load->model('pages/page');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_page') == true) {
			$this->load->helper('product_helper');
			$this->load->model('product/product_function');
			//$this->load->model('front_functions/product/pro_functions');
			
			
			
			
			
			$data['report'] = '';
			if (isset($_POST['add_pro'])) {
			$this->form_validation->set_rules('name', 'Product Name', 'trim|required|xss_clean|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('model', 'Model', 'trim|required|xss_clean|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('men_id', 'Brand', 'trim|required|xss_clean|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('pro_cat_id', 'Product Catagory', 'trim|required|xss_clean|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('filter', 'Filter', 'trim|required|xss_clean');
			$this->form_validation->set_rules('color', 'Color', 'trim|required|xss_clean');
			$this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Point', 'Point', 'trim|required|xss_clean]');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean');
			$this->form_validation->set_rules('quality', 'Quality', 'trim|required|xss_clean');
			$this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('special', 'Special', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
			
				if ($this->form_validation->run() == true) {
				$data['report'] = $this->product_function->add_new_product();
				}
			}
			
			$this->load->view('admin/product/add', $data);
			
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function edit($pro_id)
	{
		$data['pro_id'] = $pro_id;
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_page') == true) {
			$this->load->helper('product_helper');
			$this->load->model('product/product_function');
			//$this->load->model('front_functions/product/pro_functions');
			
			$selete_page = $this->db->get_where('products', array('pro_id' => $pro_id));
			$data['row'] = $selete_page->row_array();
			$data['report'] = $this->product_function->edit_product($pro_id);
			$data['pro_image'] = $this->product_function->view_product_image($pro_id, 150, 150);
			
			
			
			$data['report'] = '';
			if (isset($_POST['edit_pro'])) {
			$this->form_validation->set_rules('name', 'Product Name', 'trim|required|xss_clean|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('model', 'Model', 'trim|required|xss_clean|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('men_id', 'Brand', 'trim|required|xss_clean|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('pro_cat_id', 'Product Catagory', 'trim|required|xss_clean|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('filter', 'Filter', 'trim|required|xss_clean');
			$this->form_validation->set_rules('color', 'Color', 'trim|required|xss_clean');
			$this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Point', 'Point', 'trim|required|xss_clean]');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean');
			$this->form_validation->set_rules('quality', 'Quality', 'trim|required|xss_clean');
			$this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('special', 'Special', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
			
				if ($this->form_validation->run() == true) {
				$data['report'] = $this->product_function->edit_product($pro_id);
				}
			}
			
			$this->load->view('admin/product/edit', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	public function view($pro_id)
	{
		$data['pro_id'] = $pro_id;
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_page') == true) {
			$this->load->helper('product_helper');
			$this->load->model('product/product_function');
			//$this->load->model('front_functions/product/pro_functions');
			
			$selete_page = $this->db->get_where('products', array('pro_id' => $pro_id));
			$data['row'] = $selete_page->row();
			$data['report'] = $this->product_function->edit_product($pro_id);
			$data['pro_image'] = $this->product_function->view_product_image($pro_id, 150, 150);
			
			$this->load->view('admin/product/view', $data);
			
			
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class testimonial extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->library('form_validation');
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
	
	
	
	public function testimonial_list()
	{
		
		if ($this->login_status == true) {
			$this->load->library('pagination');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('testimonial_list') == true) {
			
			$data['base_url'] = base_url().'testimonial/testimonial_list/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `testimonial`")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 3;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(3);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$testimonial_list = $this->db->query("SELECT * FROM `testimonial` ORDER BY `test_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $testimonial_list->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			if ($testimonial_list->num_rows() > 0)
			{
			   $data['list_testimonial'] = $testimonial_list->result();
			}else {
				 $data['list_testimonial'] = 'No Attendance Published';	
			}
			
			//$data['result'] = $this->db->query("SELECT * FROM `testimonial`");
			$this->load->model('testimonial/testimonial_model');
			$this->load->view('admin/testimonial/list', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	public function create()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('testimonial_create') == true) {
			$this->load->model('testimonial/testimonial_model');
			$this->load->view('admin/testimonial/create');
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function preview()
	{
		
		if ($this->login_status == true) {
			if (isset($_POST['create_tc'])) {
				
				$data = array(
							'name' => $_POST['std_name'],
							'father' => $_POST['fname'],
							'mother' => $_POST['mname'],
							'village' => $_POST['village'],
							'upazilla' => $_POST['upazilla'],
							'post' => $_POST['post'],
							'district' => $_POST['district'],
							'dob' => $_POST['dob'],
							'exam_name' => $_POST['examination'],
							'reg_no' => $_POST['reg_number'],
							'seassion' => $_POST['seassion'],
							'roll_no' => $_POST['roll'],
							'ex_center' => $_POST['center'],
							'group' => $_POST['group'],
							'gpa' => $_POST['gpa'],
							'publish_date' => $_POST['publish_result']
							);
				
				$this->db->insert('testimonial', $data);
				$data["test_id"] = $this->db->insert_id();
			}
			
			if ($this->functions->hasPermission('testimonial_create') == true) {
			$this->load->view('admin/testimonial/preview', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	public function view($test_id)
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('testimonial_view') == true) {
			$data['test_id'] = $test_id;
			$data['result'] = $this->db->query("SELECT * FROM `testimonial` WHERE `test_id` = '$test_id'");
			$this->load->model('testimonial/testimonial_model');
			$this->load->view('admin/testimonial/view', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	
	public function view_testimonial_print($test_id)
	{
		
		if ($this->login_status == true) {
			if ($this->functions->hasPermission('testimonial_view') == true) {
			$data['test_id'] = $test_id;
			$data['result'] = $this->db->query("SELECT * FROM `testimonial` WHERE `test_id` = '$test_id'")->row();
			$this->load->view('admin/testimonial/view_testimonial_print', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
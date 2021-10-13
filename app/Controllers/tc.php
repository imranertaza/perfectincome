<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tc extends CI_Controller {
	
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
	 
	 
	 
	
	public function tc_list()
	{
		if ($this->login_status == true) {
			$this->load->library('pagination');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('tc_list') == true) {
			
			$data['base_url'] = base_url().'tc/tc_list/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `tc`")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 3;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(3);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$tc_list = $this->db->query("SELECT * FROM `tc` ORDER BY `tc_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $tc_list->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			if ($tc_list->num_rows() > 0)
			{
				$data['list_tc'] = $tc_list->result();
			}else {
				$data['list_tc'] = 'No Attendance Published';	
			}
				
			//$data['result'] = $this->db->query("SELECT * FROM `tc`");
			$this->load->model('testimonial/testimonial_model');
			$this->load->view('admin/tc/list', $data);
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
			if ($this->functions->hasPermission('tc_create') == true) {
			$this->load->model('testimonial/testimonial_model');
			$this->load->view('admin/tc/create');
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
							'post' => $_POST['post_office'],
							/*'village' => $_POST['village'],
							'upazilla' => $_POST['upazilla'],*/
							'post' => $_POST['post_office'],
							'district' => $_POST['district'],
							'admitted' => $_POST['admitted'],
							'admitted_class' => $_POST['admitted_class'],
							'promoted_class' => $_POST['promoted_class'],
							'dob' => $_POST['dob'],
							'age' => $_POST['age'],
							'reg_no' => $_POST['reg_number'],
							'character' => $_POST['character'],
							'roll_no' => $_POST['roll'],
							'cause_of_leaving' => $_POST['cause_of_leaving'],
							);
				
				$this->db->insert('tc', $data);
				$data["tc_id"] = $this->db->insert_id();
			}
			
			if ($this->functions->hasPermission('tc_create') == true) {
			$this->load->view('admin/tc/preview', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	public function view($tc_id)
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('tc_view') == true) {
			$data['tc_id'] = $tc_id;
			$data['result'] = $this->db->query("SELECT * FROM `tc` WHERE `tc_id` = '$tc_id'");
			$this->load->model('testimonial/testimonial_model');
			$this->load->view('admin/tc/view', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	public function view_tc_print($tc_id)
	{
		
		if ($this->login_status == true) {
			if ($this->functions->hasPermission('tc_view') == true) {
			$data['tc_id'] = $tc_id;
			$data['result'] = $this->db->query("SELECT * FROM `tc` WHERE `tc_id` = '$tc_id'")->row();
			$this->load->view('admin/tc/view_tc_print', $data);
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class general_settings extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->model('users/user_login');
		$this->load->library('form_validation');
		
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
	public function index()
	{
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('general_settings') == true) {
			$this->load->model('settings/global_settings');
			$this->load->view('admin/global/settings_page');
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
	
	public function slider()
	{
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->library('pagination');
			$this->load->model('functions');
			
			if ($this->functions->hasPermission('slider') == true) {
			
			$data['base_url'] = base_url().'general_settings/slider/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` DESC")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 3;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(3);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$q_slide = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'gallery' ORDER BY `sl_id` DESC");
			if ($q_slide->num_rows() > 0) {
				$data['records'] = $q_slide->result();
			}else {
				$data['records'] = "No Slide Found";
			}
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('admin/slider/list', $data);
			
			
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
	
	public function create_slide()
	{
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->model('settings/global_settings');
			
			if ($this->functions->hasPermission('slider') == true) {
			$data['report'] = '';
			if (isset($_POST['create_slide'])) {
				$this->form_validation->set_rules('sl_name', 'Slide Name', 'trim|required|xss_clean');
				//$this->form_validation->set_rules('fname', 'Picture', 'trim|required|xss_clean');
				if ($this->form_validation->run() == true) {
				
				$data['report'] = $this->global_settings->upload_image();
				}else {
				$data['report'] = '<p class="error">Slider did not uploaded</p>'.validation_errors();
				}
			}
				
			$this->load->view('admin/slider/upload', $data);
			
			
			
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
	
	public function gallery()
	{
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->library('pagination');
			$this->load->model('functions');
			
			if ($this->functions->hasPermission('gallery') == true) {
			
			$data['base_url'] = base_url().'general_settings/gallery/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'gallery' ORDER BY `sl_id` DESC")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 3;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(3);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$q_slide = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'gallery' ORDER BY `sl_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			if ($q_slide->num_rows() > 0) {
				$data['records'] = $q_slide->result();
			}else {
				$data['records'] = "No Slide Found";
			}
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('admin/gallery/list', $data);
			
			
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
	
	
	public function upload_image_gallery()
	{
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->model('settings/global_settings');
			
			if ($this->functions->hasPermission('gallery') == true) {
			$data['report'] = '';
			if (isset($_POST['create_gallery'])) {
				$this->form_validation->set_rules('sl_name', 'Gallery Name', 'trim|required|xss_clean');
				//$this->form_validation->set_rules('fname', 'Picture', 'trim|required|xss_clean');
				if ($this->form_validation->run() == true) {
				
				$data['report'] = $this->global_settings->upload_image();
				}else {
				$data['report'] = '<p class="error">Slider did not uploaded</p>'.validation_errors();
				}
			}
				
			$this->load->view('admin/gallery/upload', $data);
			
			
			
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
	
	
	public function download_backup() {
		// Load the DB utility class
		$this->load->dbutil();
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('backup/school_sql_'.date('d-m-Y').time().'.gz', $backup);
		
		// Load the Download helper and send the file to your desktop
		$this->load->helper('Download');
		force_download('school_sql_'.date('d-m-Y').time().'.gz', $backup); 
	}
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
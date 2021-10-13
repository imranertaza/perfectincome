<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class commitee extends CI_Controller {
	
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
	

	public function member_list()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('page_list') == true) {
			$this->load->model('commitee/commitee_function');
			$this->load->library('pagination');
			
			
			$name = isset($_POST['name']) ? $_POST['name'] : 0;
			if (!empty($name)) { $name_src = "`name` LIKE '%$name%'"; }else { $name_src = "1=1"; }
			
			$data['base_url'] = base_url().'admin_area/commitee/member_list/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `commitee` WHERE $name_src AND `type` = 'm_member' ORDER BY `tec_id` DESC")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 4;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(4);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$all_teacher = $this->db->query("SELECT * FROM `commitee` WHERE $name_src AND `type` = 'm_member' ORDER BY `tec_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $all_teacher->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('admin/man_commitee/members_list', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function add_new_member()
	{
		
		if ($this->login_status == true) {
			$this->load->model('pages/page');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_page') == true) {
			$this->load->helper('student_functions_helper');
			$this->load->model('commitee/commitee_function');
			//$this->load->model('front_functions/product/pro_functions');
			
			
			$data['report'] = '';
			if (isset($_POST['add_pro'])) {
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[teachers.mobile]|regex_match[/^[0-9]{11}$/]|integer|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
				if ($this->form_validation->run() == true) {
				$data['report'] = $this->commitee_function->add_new_commitee();
				}else {
				$data['report'] = '<div class="error">'.validation_errors().'</p>';
				}
			}
			
			$this->load->view('admin/man_commitee/add_new_member', $data);
			
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	public function edit_member($tec_id)
	{
		$data['tec_id'] = $tec_id;
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_page') == true) {
			$this->load->helper('student_functions_helper');
			$this->load->model('commitee/commitee_function');
			//$this->load->model('front_functions/product/pro_functions');
			
			$selete_page = $this->db->get_where('commitee', array('tec_id' => $tec_id));
			$data['row'] = $selete_page->row_array();
			
			$data['pro_image'] = $this->commitee_function->view_commitee_image($tec_id, 150, 150);
			
			$data['report'] = '';
			if (isset($_POST['edit_Member'])) {
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|edit_unique[teachers.mobile.'.$tec_id.']|regex_match[/^[0-9]{11}$/]|integer|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
				if ($this->form_validation->run() == true) {
				$data['report'] = $this->commitee_function->edit_commitee($tec_id);
				}
			}
			
			
			
			$this->load->view('admin/man_commitee/edit_member', $data);
			
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	public function view($tec_id)
	{
		$data['tec_id'] = $tec_id;
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_page') == true) {
			$this->load->helper('commitee_functions_helper');
			$this->load->model('commitee/commitee_function');
			//$this->load->model('front_functions/product/pro_functions');
			
			$selete_page = $this->db->get_where('commitee', array('tec_id' => $tec_id));
			$data['row'] = $selete_page->row_array();
			$data['report'] = $this->commitee_function->edit_commitee($tec_id);
			$data['pro_image'] = $this->commitee_function->view_commitee_image($tec_id, 150, 150);
			
			$this->load->view('admin/man_commitee/view_member', $data);
			
			
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
<?php
class classes extends CI_Controller {
	
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

	public function add_class()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_class') == true) {
				$this->load->model('classes/class_mod');
				$this->load->view('admin/classes/add_class');
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
	
	
	
	public function class_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('class_list') == true) {
				$this->load->model('classes/class_mod');
				$this->load->library('pagination');
				
				$data['base_url'] = base_url().'classes/class_list/';
				$data['total_rows'] = $this->db->query("SELECT * FROM `classes` ORDER BY `class_id` DESC")->num_rows();
				$data['per_page'] = 10; 
				$data['uri_segment'] = 3;
				$data['num_links'] = 5;
				$get_segment_uri = $this->uri->segment(3);
				$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
				$all_teacher = $this->db->query("SELECT * FROM `classes` ORDER BY `class_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
				$data['records'] = $all_teacher->result();
				$this->pagination->initialize($data);
				$data['pagination'] = $this->pagination->create_links();
				
				$this->load->view('admin/classes/class_list', $data);
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
	
	
	public function edit_class($class_id)
	{
		$data['class_id'] = $class_id;
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_class') == true) {
				$this->load->model('classes/class_mod');
				$this->load->view('admin/classes/edit_class', $data);
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
	
	
	public function add_group()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_group') == true) {
				$this->load->helper('student_functions_helper');
				
				$data['success'] = '';
				if (isset($_POST['add_group'])) {
					$group_name = $_POST['group_name'];
					//$class = $_POST['class'];
					
					$info = array(
					   'group_name' => $group_name
					   //'class_id' => $class
					);
					$data['insert'] = $this->db->insert('class_group', $info); 
					$data['success'] = 'Group Successfully Added';
				}
				
				$this->load->view('admin/classes/add_group', $data);
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
	
	
	
	public function group_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('group_list') == true) {
				$this->load->library('pagination');

				$data['base_url'] = base_url().'classes/group_list/';
				$data['total_rows'] = $this->db->query("SELECT * FROM `class_group` ORDER BY `grp_id` DESC")->num_rows();
				$data['per_page'] = 10; 
				$data['uri_segment'] = 3;
				$data['num_links'] = 5;
				$get_segment_uri = $this->uri->segment(3);
				$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
				$all_student = $this->db->query("SELECT * FROM `class_group` ORDER BY `grp_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
				$data['records'] = $all_student->result();
				$this->pagination->initialize($data);
				$data['pagination'] = $this->pagination->create_links();
				
				$this->load->view('admin/classes/group_list', $data);
				
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
	
	
	public function edit_group($group_id)
	{
		$data['group_id'] = $group_id;
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_group') == true) {
				$this->load->helper('student_functions_helper');
				
				
				// For editing group
				$data['success'] = '';
				if (isset($_POST['edit_group'])) {
					$group_name = $_POST['group_name'];
					//$class = $_POST['class'];
					
					$info = array(
					   'group_name' => $group_name
					   //'class_id' => $class
					);
					$data['update'] = $this->db->update('class_group', $info, array('grp_id' => $group_id)); 
					$data['success'] = 'Group Successfully Updated';
				}
				
				
				// For showing group info
				$group = $this->db->query("SELECT * FROM `class_group` WHERE `grp_id` = '$group_id'");
				if ($group->num_rows() > 0)
				{
					$data['group_info'] = $group->row();
				}
				
				$this->load->view('admin/classes/edit_group', $data);
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
	
	
	
	
	public function subject_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			
			if ($this->functions->hasPermission('group_list') == true) {
				$this->load->library('pagination');
				
				$subject = isset($_POST['subject']) ? $_POST['subject'] : 0;
				if (!empty($subject)) { $subject_src = "`sub_name` LIKE '%$subject%'"; }else { $subject_src = "1=1"; }
				
				$data['base_url'] = base_url().'classes/subject_list/';
				$data['total_rows'] = $this->db->query("SELECT * FROM `subject` WHERE $subject_src ORDER BY `sub_id` DESC")->num_rows();
				$data['per_page'] = 10; 
				$data['uri_segment'] = 3;
				$data['num_links'] = 5;
				$get_segment_uri = $this->uri->segment(3);
				$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
				$all_subject = $this->db->query("SELECT * FROM `subject` WHERE $subject_src ORDER BY `sub_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
				$data['records'] = $all_subject->result();
				$this->pagination->initialize($data);
				$data['pagination'] = $this->pagination->create_links();
				
				if ($data['records']) {
					$data['list_subject'] = $all_subject->result();
				}else {
					$data['list_subject'] = 'No record found.';	
				}
				
				$this->load->view('admin/subject/subject_list', $data);
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
	
	
	
	public function add_subject()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->helper('student_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('group_list') == true) {
				
				$data['msg'] = '';
				
				if (isset($_POST['add_subject'])) {
					$info = array(
							//'type' => $_POST['s_type'],
							//'class_id' => $_POST['class'],
							//'grp_id' => $_POST['group'],
							'sub_name' => $_POST['subject_name'],
							);
				
					$insert = $this->db->insert('subject', $info);
					
					if ($insert) {
						$data['msg'] = '<p class="success">Subject Successfully Added.</p>';
					}else {
						$data['msg'] = '<p class="error">Something wrong.</p>';
					}
				}
				
				$this->load->view('admin/subject/add_subject', $data);
				
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
	
	
	
	
	
	public function edit_subject($sub_id)
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->helper('student_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('group_list') == true) {
				
				$data['msg'] = '';
				
				if (isset($_POST['edit_subject'])) {
					$data = array(
							//'type' => $_POST['s_type'],
							//'class_id' => $_POST['class'],
							//'grp_id' => $_POST['group'],
							'name' => $_POST['subject_name'],
							);
				
					//$insert = $this->db->insert('subject', $data);
					$update = $this->db->update('subject', $data, array('sub_id' => $sub_id)); 
					
					if ($update) {
						$data['msg'] = '<p class="success">Subject Successfully Updated.</p>';
					}else {
						$data['msg'] = '<p class="error">Something wrong.</p>';
					}
				}
				
				$data['sub_id'] = $sub_id;
				$all_subject = $this->db->query("SELECT * FROM `subject` WHERE `sub_id` = ".$sub_id);
				$data['records'] = $all_subject->row();
				
				$this->load->view('admin/subject/edit_subject', $data);
				
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
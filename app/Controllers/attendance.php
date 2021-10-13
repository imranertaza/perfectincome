<?php
class attendance extends CI_Controller {
	
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

	/*public function select_class() {
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->helper('student_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('attendance') == true) {
				$this->load->view('admin/attendance/select_class');
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
	}*/
	
	
	public function attendance_list() {
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->library('pagination');
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('attendance') == true) {
				
					
					$date_from = isset($_POST['date_from']) ? $_POST['date_from'] : 0;
					$date_to = isset($_POST['date_to']) ? $_POST['date_to'] : 0;
					$class_id = isset($_POST['class']) ? $_POST['class'] : 0;
					$group_id = isset($_POST['group']) ? $_POST['group'] : 0;
					if ($date_from != 0) { $date_src = "`date` = '$date_from'"; }else { $date_src = "1=1"; }
					if ((!empty($date_from)) AND (!empty($date_to))) { $date_src = "(`date` BETWEEN '$date_from' AND '$date_to')"; }
					if ($class_id != 0) { $class = "`class_id` = '$class_id'"; }else { $class = "1=1"; }
					if ($group_id != 0) { $group = "`group_id` = '$group_id'"; }else { $group = "1=1"; }
					
					$data['base_url'] = base_url().'attendance/attendance_list/';
					$data['total_rows'] = $this->db->query("SELECT * FROM `attendance` WHERE $date_src AND $class AND $group")->num_rows();
					$data['per_page'] = 10; 
					$data['uri_segment'] = 3;
					$data['num_links'] = 5;
					$get_segment_uri = $this->uri->segment(3);
					$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
					$attendance_list = $this->db->query("SELECT * FROM `attendance` WHERE $date_src AND $class AND $group ORDER BY `att_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
					$data['records'] = $attendance_list->result();
					$this->pagination->initialize($data);
					$data['pagination'] = $this->pagination->create_links();
					if ($attendance_list->num_rows() > 0)
					{
					   $data['list_attendance'] = $attendance_list->result();
					}else {
						 $data['list_attendance'] = 'No Attendance Published';	
					}
					$this->load->view('admin/attendance/attendance_list', $data);
					
					
				
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
	
	
	public function add_attendance() {
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->library('pagination');
			$this->load->helper('student_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('attendance') == true) {
		
			$data['msg'] = '';
			if(isset($_POST['add_attendance'])) {
				$date = htmlentities($_POST['date']);
				$class_id = htmlentities($_POST['class']);
				$group_id = htmlentities($_POST['group']);
				$total_student = htmlentities($_POST['total_student']);
				$attendance = htmlentities($_POST['attendance']);
				$data['total_student'] = count_student($class_id, $group_id);
				
				$data = array(
				   'date' => $date,
				   'class_id' => $class_id,
				   'group_id' => $group_id,
				   'attendance' => $attendance
				);
				
				$insert = $this->db->insert('attendance', $data);
				if ($insert) {
					$data['msg'] = '<p class="success">Attendance Successfully Added!</p>';
				}else{
					$data['msg'] = '<p class="error">Data did not add. Something wrong.</p>';
				}
				
			}
			
			$this->load->view('admin/attendance/add_attendance', $data);
			
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
	
	
	
	public function edit_attendance($id) {
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->library('pagination');
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_attendance') == true) {
		
			
			$query = $this->db->query("SELECT * FROM `attendance` WHERE `att_id` = '$id'");
			$row = $query->row();
			$data['date'] = $row->date;
			$data['class_id'] = $row->class_id;
			$data['group_id'] = $row->group_id;
			$data['attendance'] = $row->attendance;
			$class_id = $data['class_id'];
			$group_id = $data['group_id'];
			$data['msg'] = '';
			
			if(isset($_POST['edit_attendance'])) {
				$date = htmlentities($_POST['date']);
				$class_id = htmlentities($_POST['class']);
				$group_id = htmlentities($_POST['group']);
				$total_student = htmlentities($_POST['total_student']);
				$attendance = htmlentities($_POST['attendance']);
				
				$data = array(
				   'date' => $date,
				   'class_id' => $class_id,
				   'group_id' => $group_id,
				   'attendance' => $attendance
				);
				$this->db->where('att_id', $id);
				$update = $this->db->update('attendance', $data);
				if ($update) {
					$data['msg'] = '<p class="success">Attendance Successfully Updated!</p>';
				}else{
					$data['msg'] = '<p class="error">Data did not updated. Something wrong.</p>';
				}
			}
			
			
			$data['att_id'] = $row->att_id;
			$data['total_student'] = count_student($data['class_id'], $data['group_id']);
			$this->load->view('admin/attendance/edit_attendance', $data);
			
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
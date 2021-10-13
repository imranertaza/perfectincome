<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class exam extends CI_Controller {
	
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
	
	
	
	public function exam_list()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->library('pagination');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			
			
			if ($this->functions->hasPermission('exam_list') == true) {
				
			$year = isset($_POST['year']) ? $_POST['year'] : 0;
			$class_id = isset($_POST['class']) ? $_POST['class'] : 0;
			$group_id = isset($_POST['group']) ? $_POST['group'] : 0;
			if ($year != 0) { $year_src = "`year` = '$year'"; }else { $year_src = "1=1"; }
			if ($class_id != 0) { $class = "`class_id` = '$class_id'"; }else { $class = "1=1"; }
			if ($group_id != 0) { $group = "`grp_id` = '$group_id'"; }else { $group = "1=1"; }
			
			$data['base_url'] = base_url().'admin_area/exam/exam_list/';
			$data['total_rows'] = $this->db->query("SELECT * FROM `exam` WHERE $year_src AND $class AND $group")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 4;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(4);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$exam_list = $this->db->query("SELECT * FROM `exam` WHERE $year_src AND $class AND $group ORDER BY `exm_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $exam_list->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			
			if ($exam_list->num_rows() > 0)
			{
			   $data['list_exam'] = $exam_list->result();
			}else {
				 $data['list_exam'] = '<p class="alert alert-info not_fount">No Exam Found</p>';	
			}
			
			$this->load->view('admin/exam/exam_list', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			
			
			$this->load->view('admin/footer');
			
			
			
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	public function add_exam() {
		
		if ($this->login_status == true) {
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			
			
			if ($this->functions->hasPermission('exam_list') == true) {
			
			$data['msg'] = '';
			
			if (isset($_POST['add_exam'])) {
				$data = array(
							'year' => $_POST['year'],
							'class_id' => $_POST['class'],
							'grp_id' => $_POST['group'],
							'exam_name' => $_POST['exam_name'],
							);
				
				$insert = $this->db->insert('exam', $data);
				
				if ($insert) {
					$data['msg'] = '<p class="success">Exam Successfully Created.</p>';
				}else {
					$data['msg'] = '<p class="error">Something wrong.</p>';
				}
			}
			
			
			
			
			$this->load->view('admin/exam/add_exam', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			
			
			$this->load->view('admin/footer');
			
			
			
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	
	
	public function edit_exam($exm_id) {
		
		if ($this->login_status == true) {
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			
			
			if ($this->functions->hasPermission('exam_list') == true) {
			
			$data['msg'] = '';
			
			if (isset($_POST['edit_exam'])) {
				$data = array(
							'year' => $_POST['year'],
							'class_id' => $_POST['class'],
							'grp_id' => $_POST['group'],
							'exam_name' => $_POST['exam_name'],
							);
				$this->db->where('exm_id', $exm_id);
				$update = $this->db->update('exam', $data);
				
				if ($update) {
					$data['msg'] = '<p class="success">Exam Successfully Updated.</p>';
				}else {
					$data['msg'] = '<p class="error">Something wrong.</p>';
				}
			}
			
			$edit_exam = $this->db->query("SELECT * FROM `exam` WHERE `exm_id` = '$exm_id'");
			$data['exm_id'] = $exm_id;
			$data['row'] = $edit_exam->row();
			
			$this->load->view('admin/exam/edit_exam', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			
			
			$this->load->view('admin/footer');
			
			
			
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	
	
	public function add_result($exm_id) {
		if ($this->login_status == true) {
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['exm_id'] = $exm_id;
			
			if ($this->functions->hasPermission('exam_list') == true) {
			
			$data['msg'] = '';
			
			if (isset($_POST['submit_result'])) {
				
				$result_array = $_REQUEST['subject'];
				$result = json_encode($result_array);
				
				$data = array(
							'exm_id' => $data['exm_id'],
							'roll_no' => $_POST['roll'],
							'result' => $result,
							);
				
				$insert = $this->db->insert('result', $data);
				
				if ($insert) {
					$data['msg'] = '<p class="success">Result for the student is submitted.</p>';
				}else {
					$data['msg'] = '<p class="error">Something wrong.</p>';
				}
			}
			
			
			$common_query = $this->db->query("SELECT `sub_name` FROM `subject` WHERE `type` = 'Common' AND `class_id` = 0 AND `grp_id` = 0");
			$data['common'] = $common_query->result();
			$subject_ord_query = $this->db->query("SELECT `sub_name` FROM `exam`, `subject` WHERE `type` = 'Subject Oriented' AND `subject`.`class_id` = `exam`.`class_id` AND `subject`.`grp_id` = `exam`.`grp_id` AND `exm_id` =".$exm_id);
			$data['subject_ord'] = $subject_ord_query->result();
			$this->load->view('admin/exam/add_result', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			
			
			$this->load->view('admin/footer');
			
			
			
		}else  {
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	
	
	
	
	public function view_result($exm_id) {
		if ($this->login_status == true) {
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->library('pagination');
			$data['exm_id'] = $exm_id;
			
			if ($this->functions->hasPermission('exam_list') == true) {
			$data['msg'] = '';
			
			
			
			

			   
			   
			$data['base_url'] = base_url().'admin_area/exam/view_result/'.$exm_id;
			$data['total_rows'] = $this->db->query("SELECT * FROM `result` WHERE `exm_id` = '$exm_id' ORDER BY `res_id` DESC")->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 5;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(5);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			
			$result_list = $this->db->query("SELECT * FROM `result` WHERE `exm_id` = '$exm_id' ORDER BY `res_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $result_list->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			   
			   
			//$result_query = $this->db->query("SELECT * FROM `result` WHERE `exm_id` = '$exm_id'");
			if ($data['total_rows'] > 0)
			{
			   $data['list_result'] = $data['records'];
			}else {
				 $data['list_result'] = '<p class="alert alert-info not_fount">No Result Found</p>';	
			}
			
			
			
			$this->load->view('admin/exam/view_result', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	
	
	
	
	public function view_result_details($res_id) {
		if ($this->login_status == true) {
			$this->load->model('student/student_function');
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['res_id'] = $res_id;
			$data['subject_result'] = '';
			
			if ($this->functions->hasPermission('exam_list') == true) {
			$data['msg'] = '';
			
			$result_query = $this->db->query("SELECT * FROM `result` WHERE `res_id` = '$res_id'");
			$result_row = $result_query->row();
			
			
			// Making result
			$result = json_decode($result_row->result);
			$single_fail = array();
			foreach($result->sub_name as $key=>$val){
				$subject_name = $val;
				$subject_type = $result->sub_type[$key];
				$cq_mark = $result->marks->cq[$key];
				$mcq_mark = empty($result->marks->mcq[$key]) ? 'N/A' : $result->marks->mcq[$key];
				$practical_mark = empty($result->marks->practical[$key]) ? 'N/A' : $result->marks->practical[$key];
				
				// Calculating if fails
				$point = true;
				if ((($subject_type == 'cwp') || ($subject_type == 'cwp4')) && (($cq_mark < 13) || ($mcq_mark < 12) || ($practical_mark < 12))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) && (($cq_mark < 20) || ($mcq_mark < 13))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) && (($cq_mark < 20) || ($practical_mark < 13))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'ncwtp') || ($subject_type == 'ncwtp4')) && ($cq_mark < 33)) {
					$grade = 'F';
					$point = 0;
				}
				else {}
				
				// Calculating total marks according to type
				if (($subject_type == 'cwp') || ($subject_type == 'cwp4')) {
					$total_marks = $cq_mark + $mcq_mark + $practical_mark;
				}else if (($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) {
					$total_marks = $cq_mark + $mcq_mark;
				}else if (($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) {
					$total_marks = $cq_mark + $practical_mark;
				}else {
					$total_marks = $cq_mark;
				}
				
				
				// Calculating Gread
				if ($point > 0 ) {
				if($total_marks >= 80) { $grade = 'A+'; $point = 5; }
				else if($total_marks >= 70) { $grade = 'A'; $point = 4; }
				else if($total_marks >= 60) { $grade = 'A-'; $point = 3.5; }
				else if($total_marks >= 50) { $grade = 'B'; $point = 3; }
				else if($total_marks >= 40) { $grade = 'C'; $point = 2; }
				else if($total_marks >= 33) { $grade = 'D'; $point = 1; }
				}else { array_push($single_fail, array($key=>'F','subject'=>$val));	}
					
				
				$data['subject_result'] .= '<tr><td>'.$subject_name.'</td><td>'.$cq_mark.'</td><td>'.$mcq_mark.'</td><td>'.$practical_mark.'</td><td>'.$total_marks.'</td><td>'.$point.'</td><td>'.$grade.'</td></tr>';
				
				if (($subject_type == 'cwp4') || ($subject_type == 'cwtp4') || ($subject_type == 'ncwp4') || ($subject_type == 'ncwtp4')) {
					$point = $point - 2;
					if ($point < 0) { $point = 0; }
				}
				$total_point = @$total_point + $point;
			}
			
			$avg = $total_point/6 . "<br />";
			$data['point_result'] = ($avg>5) ? '5' : $avg;
			
			
			if(in_array_r('F', $single_fail)){ $data['grade_result'] = 'F'; $data['point_result'] = ''; }
			else {
			if($avg >= 5) { $grade = 'A+'; }
			else if($avg >= 4) { $grade = 'A'; $point = 4; }
			else if($avg >= 3.5) { $grade = 'A-'; }
			else if($avg >= 3) { $grade = 'B'; }
			else if($avg >= 2) { $grade = 'C'; }
			else if($avg >= 1) { $grade = 'D'; }
			else {$grade = 'F'; }
			$data['grade_result'] = $grade;
			}
			
			
			
			// Indivisual student details
			//print "SELECT * FROM `result`, `exam`, `students` WHERE `result`.`exm_id` = `exam`.`exm_id` AND `exam`.`class_id` = `students`.`class_id` AND `exam`.`grp_id` = `students`.`group_id` AND `result`.`res_id`='".$res_id."' AND `result`.`roll_no`=`students`.`roll_no` AND `result`.`roll_no`='".$result_row->roll_no."'";
			$indivisual_query = $this->db->query("SELECT * FROM `result`, `exam`, `students` WHERE `result`.`exm_id` = `exam`.`exm_id` AND `exam`.`class_id` = `students`.`class_id` AND `exam`.`grp_id` = `students`.`group_id` AND `result`.`res_id`='".$res_id."' AND `result`.`roll_no`=`students`.`roll_no` AND `result`.`roll_no`='".$result_row->roll_no."'");
			$indivisual_details = $indivisual_query->row();
			
			$data['student_name'] = $indivisual_details->name;
			$data['student_roll'] = $indivisual_details->roll_no;
			$data['student_reg'] = $indivisual_details->reg_no;
			$data['std_id'] = $indivisual_details->std_id;
			
			
			
			$this->load->view('admin/exam/view_result_details', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	
	
	public function view_result_details_print($res_id) {
		if ($this->login_status == true) {
			$this->load->model('student/student_function');
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			
			$data['res_id'] = $res_id;
			$data['subject_result'] = '';
			
			if ($this->functions->hasPermission('exam_list') == true) {
			$data['msg'] = '';
			
			$result_query = $this->db->query("SELECT * FROM `result` WHERE `res_id` = '$res_id'");
			$result_row = $result_query->row();
			
			
			// Making result
			$result = json_decode($result_row->result);
			$single_fail = array();
			foreach($result->sub_name as $key=>$val){
				$subject_name = $val;
				$subject_type = $result->sub_type[$key];
				$cq_mark = $result->marks->cq[$key];
				$mcq_mark = empty($result->marks->mcq[$key]) ? 'N/A' : $result->marks->mcq[$key];
				$practical_mark = empty($result->marks->practical[$key]) ? 'N/A' : $result->marks->practical[$key];
				
				// Calculating if fails
				$point = true;
				if ((($subject_type == 'cwp') || ($subject_type == 'cwp4')) && (($cq_mark < 13) || ($mcq_mark < 12) || ($practical_mark < 12))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) && (($cq_mark < 20) || ($mcq_mark < 13))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) && (($cq_mark < 20) || ($practical_mark < 13))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'ncwtp') || ($subject_type == 'ncwtp4')) && ($cq_mark < 33)) {
					$grade = 'F';
					$point = 0;
				}
				else {}
				
				// Calculating total marks according to type
				if (($subject_type == 'cwp') || ($subject_type == 'cwp4')) {
					$total_marks = $cq_mark + $mcq_mark + $practical_mark;
				}else if (($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) {
					$total_marks = $cq_mark + $mcq_mark;
				}else if (($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) {
					$total_marks = $cq_mark + $practical_mark;
				}else {
					$total_marks = $cq_mark;
				}
				
				
				// Calculating Gread
				if ($point > 0 ) {
				if($total_marks >= 80) { $grade = 'A+'; $point = 5; }
				else if($total_marks >= 70) { $grade = 'A'; $point = 4; }
				else if($total_marks >= 60) { $grade = 'A-'; $point = 3.5; }
				else if($total_marks >= 50) { $grade = 'B'; $point = 3; }
				else if($total_marks >= 40) { $grade = 'C'; $point = 2; }
				else if($total_marks >= 33) { $grade = 'D'; $point = 1; }
				}else { array_push($single_fail, array($key=>'F','subject'=>$val));	}
					
				
				$data['subject_result'] .= '<tr><td>'.$subject_name.'</td><td>'.$cq_mark.'</td><td>'.$mcq_mark.'</td><td>'.$practical_mark.'</td><td>'.$total_marks.'</td><td>'.$point.'</td><td>'.$grade.'</td></tr>';
				
				if (($subject_type == 'cwp4') || ($subject_type == 'cwtp4') || ($subject_type == 'ncwp4') || ($subject_type == 'ncwtp4')) {
					$point = $point - 2;
					if ($point < 0) { $point = 0; }
				}
				$total_point = @$total_point + $point;
			}
			
			$avg = $total_point/6 . "<br />";
			$data['point_result'] = ($avg>5) ? '5' : $avg;
			
			
			if(in_array_r('F', $single_fail)){ $data['grade_result'] = 'F'; $data['point_result'] = ''; }
			else {
			if($avg >= 5) { $grade = 'A+'; }
			else if($avg >= 4) { $grade = 'A'; $point = 4; }
			else if($avg >= 3.5) { $grade = 'A-'; }
			else if($avg >= 3) { $grade = 'B'; }
			else if($avg >= 2) { $grade = 'C'; }
			else if($avg >= 1) { $grade = 'D'; }
			else {$grade = 'F'; }
			$data['grade_result'] = $grade;
			}
			
			
			
			// Indivisual student details
			//print "SELECT * FROM `result`, `exam`, `students` WHERE `result`.`exm_id` = `exam`.`exm_id` AND `exam`.`class_id` = `students`.`class_id` AND `exam`.`grp_id` = `students`.`group_id` AND `result`.`res_id`='".$res_id."' AND `result`.`roll_no`=`students`.`roll_no` AND `result`.`roll_no`='".$result_row->roll_no."'";
			$indivisual_query = $this->db->query("SELECT * FROM `result`, `exam`, `students` WHERE `result`.`exm_id` = `exam`.`exm_id` AND `exam`.`class_id` = `students`.`class_id` AND `exam`.`grp_id` = `students`.`group_id` AND `result`.`res_id`='".$res_id."' AND `result`.`roll_no`=`students`.`roll_no` AND `result`.`roll_no`='".$result_row->roll_no."'");
			$indivisual_details = $indivisual_query->row();
			
			$data['student_name'] = $indivisual_details->name;
			$data['student_roll'] = $indivisual_details->roll_no;
			$data['student_reg'] = $indivisual_details->reg_no;
			$data['std_id'] = $indivisual_details->std_id;
			
			
			$this->load->view('admin/exam/view_result_details_print', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	
	
	
	public function edit_result($exm_id, $res_id) {
		if ($this->login_status == true) {
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			
			if ($this->functions->hasPermission('exam_list') == true) {
			$data['msg'] = '';
			$sub_result = '';
			
			if (isset($_POST['update_result'])) {
				$result_array = $_REQUEST['subject'];
				$result = json_encode($result_array);
				$data = array(
							'exm_id' => $exm_id,
							'roll_no' => $_POST['roll'],
							'result' => $result,
							);
				
				//$insert = $this->db->insert('result', $data);
				$this->db->where('res_id', $res_id);
				$update = $this->db->update('result', $data);
				if ($update) {
					$data['msg'] = '<p class="success">Successfully Updated.</p>';
				}else {
					$data['msg'] = '<p class="error">Something wrong.</p>';
				}
			}
			
			$data['exm_id'] = $exm_id;
			$data['res_id'] = $res_id;
			$result_query = $this->db->query("SELECT * FROM `result` WHERE `res_id` = '$res_id'");
			$result_row = $result_query->row();
			$data['roll'] = $result_row->roll_no;
			$result = json_decode($result_row->result);
			$single_fail = array();
			foreach($result->sub_name as $key=>$val){
				$subject_name = $val;
				$subject_type = $result->sub_type[$key];
				$cq_mark = $result->marks->cq[$key];
				$mcq_mark = empty($result->marks->mcq[$key]) ? 'N/A' : $result->marks->mcq[$key];
				$practical_mark = empty($result->marks->practical[$key]) ? 'N/A' : $result->marks->practical[$key];
				
				if ($subject_type == 'cwp') {
					$fields = '<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
								<span>MCQ</span> <input type="text" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
								<span>Practical</span> <input type="text" name="subject[marks][practical][]" value="'.$practical_mark.'" />';
				}
				if ($subject_type == 'cwtp') {
					$fields = '<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
								<span>MCQ</span> <input type="text" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
								<input type="hidden" name="subject[marks][practical][]" />';
				}
				if ($subject_type == 'ncwp') {
					$fields = '<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
								<input type="hidden" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
								<span>Practical</span> <input type="text" name="subject[marks][practical][]" value="'.$practical_mark.'" />';
				}
				if ($subject_type == 'ncwtp') {
					$fields = '<span>Written</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
								<input type="hidden" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
								<input type="hidden" name="subject[marks][practical][]" value="'.$practical_mark.'" />';
				}
				if ($subject_type == 'cwp4') {
					$fields = '<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
								<span>MCQ</span> <input type="text" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
								<span>Practical</span> <input type="text" name="subject[marks][practical][]" value="'.$practical_mark.'" />';
				}
				if ($subject_type == 'cwtp4') {
					$fields = '<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
								<span>MCQ</span> <input type="text" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
								<input type="hidden" name="subject[marks][practical][]" value="'.$practical_mark.'" />';
				}
				if ($subject_type == 'ncwp4') {
					$fields = '<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
								<input type="hidden" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
								<span>Practical</span> <input type="text" name="subject[marks][practical][]" value="'.$practical_mark.'" />';
				}
				if ($subject_type == 'ncwtp4') {
					$fields = '<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="'.$cq_mark.'" />
							   <input type="hidden" name="subject[marks][mcq][]" value="'.$mcq_mark.'" />
							   <input type="hidden" name="subject[marks][practical][]" value="'.$practical_mark.'" />';
				}
				
				$sub_result .= '<div><span>Subject</span><input type="hidden" name="subject[sub_type][]" value="'.$subject_type.'">
											<input type="text" name="subject[sub_name][]" value="'.$subject_name.'" />
											'.$fields.'
											<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>';
			}
			
			
			$data['subject_result'] = $sub_result;
			$this->load->view('admin/exam/edit_result', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	
	
	public function view_result_print($exm_id, $page_no=0) {
		if ($this->login_status == true) {
			$this->load->helper('student_functions_helper');
			$this->load->helper('settings_functions_helper');
			
			$data['exm_id'] = $exm_id;
			$data['result_list'] = '';
			
			if ($this->functions->hasPermission('exam_list') == true) {
			$data['msg'] = '';
			
			
			
			$result_query = $this->db->query("SELECT * FROM `result` WHERE `exm_id` = '$exm_id' ORDER BY `res_id` DESC LIMIT ".$page_no.", 10");
			if ($result_query->num_rows() > 0)
			{
			   	foreach ($result_query->result() as $row) {
				$total_point = '';
				$data['subject_result'] = '';   
				 
				$result_query = $this->db->query("SELECT * FROM `result` WHERE `res_id` = '$row->res_id'");
				$result_row = $result_query->row();
				
				
				// Making result
				/*$result = json_decode($result_row->result);
				$single_fail = array();
				foreach($result->sub_name as $key=>$val){
					$subject_name = $val;
					$subject_type = $result->sub_type[$key];
					$cq_mark = $result->marks->cq[$key];
					$mcq_mark = empty($result->marks->mcq[$key]) ? 'N/A' : $result->marks->mcq[$key];
					$practical_mark = empty($result->marks->practical[$key]) ? 'N/A' : $result->marks->practical[$key];
					
					// Calculating if fails
					$Point = true;
					if ((($subject_type == 'cwp') || ($subject_type == 'cwp4')) && (($cq_mark < 13) || ($mcq_mark < 12) || ($practical_mark < 12))) {
						$grade = 'F';
						$Point = 0;
					}
					else if ((($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) && (($cq_mark < 20) || ($mcq_mark < 13))) {
						$grade = 'F';
						$Point = 0;
					}
					else if ((($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) && (($cq_mark < 20) || ($practical_mark < 13))) {
						$grade = 'F';
						$Point = 0;
					}
					else if ((($subject_type == 'ncwtp') || ($subject_type == 'ncwtp4')) && ($cq_mark < 33)) {
						$grade = 'F';
						$Point = 0;
					}
					else {}
					
					// Calculating total marks according to type
					if (($subject_type == 'cwp') || ($subject_type == 'cwp4')) {
						$total_marks = $cq_mark + $mcq_mark + $practical_mark;
					}else if (($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) {
						$total_marks = $cq_mark + $mcq_mark;
					}else if (($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) {
						$total_marks = $cq_mark + $practical_mark;
					}else {
						$total_marks = $cq_mark;
					}
					
					
					// Calculating Gread
					if ($Point > 0 ) {
					if($total_marks >= 80) { $grade = 'A+'; $Point = 5; }
					else if($total_marks >= 70) { $grade = 'A'; $Point = 4; }
					else if($total_marks >= 60) { $grade = 'A-'; $Point = 3.5; }
					else if($total_marks >= 50) { $grade = 'B'; $Point = 3; }
					else if($total_marks >= 40) { $grade = 'C'; $Point = 2; }
					else if($total_marks >= 33) { $grade = 'D'; $Point = 1; }
					}else { array_push($single_fail, array($key=>'F','subject'=>$val));	}
					
					
					if (($subject_type == 'cwp4') || ($subject_type == 'cwtp4') || ($subject_type == 'ncwp4') || ($subject_type == 'ncwtp4')) {
						$Point = $Point - 2;
						if ($Point < 0) { $Point = 0; }
					}
					
					$total_point = @$total_point + $Point;
				}
				
				$avg = $total_point/6 . "<br />";
				$data['point_result'] = $avg;
				
				
				if(in_array_r('F', $single_fail)){ $data['grade_result'] = 'F'; $data['point_result'] = 'Not viewable'; }
				else {
				if($avg >= 5) { $grade = 'A+'; }
				else if($avg >= 4) { $grade = 'A'; $Point = 4; }
				else if($avg >= 3.5) { $grade = 'A-'; }
				else if($avg >= 3) { $grade = 'B'; }
				else if($avg >= 2) { $grade = 'C'; }
				else if($avg >= 1) { $grade = 'D'; }
				else {$grade = 'F'; }
				$data['grade_result'] = $grade;
				}*/
				
				
				
				
				// Making result
			$result = json_decode($result_row->result);
			$single_fail = array();
			foreach($result->sub_name as $key=>$val){
				$subject_name = $val;
				$subject_type = $result->sub_type[$key];
				$cq_mark = $result->marks->cq[$key];
				$mcq_mark = empty($result->marks->mcq[$key]) ? 'N/A' : $result->marks->mcq[$key];
				$practical_mark = empty($result->marks->practical[$key]) ? 'N/A' : $result->marks->practical[$key];
				
				// Calculating if fails
				$point = true;
				if ((($subject_type == 'cwp') || ($subject_type == 'cwp4')) && (($cq_mark < 13) || ($mcq_mark < 12) || ($practical_mark < 12))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) && (($cq_mark < 20) || ($mcq_mark < 13))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) && (($cq_mark < 20) || ($practical_mark < 13))) {
					$grade = 'F';
					$point = 0;
				}
				else if ((($subject_type == 'ncwtp') || ($subject_type == 'ncwtp4')) && ($cq_mark < 33)) {
					$grade = 'F';
					$point = 0;
				}
				else {}
				
				// Calculating total marks according to type
				if (($subject_type == 'cwp') || ($subject_type == 'cwp4')) {
					$total_marks = $cq_mark + $mcq_mark + $practical_mark;
				}else if (($subject_type == 'cwtp') || ($subject_type == 'cwtp4')) {
					$total_marks = $cq_mark + $mcq_mark;
				}else if (($subject_type == 'ncwp') || ($subject_type == 'ncwp4')) {
					$total_marks = $cq_mark + $practical_mark;
				}else {
					$total_marks = $cq_mark;
				}
				
				
				// Calculating Gread
				if ($point > 0 ) {
				if($total_marks >= 80) { $grade = 'A+'; $point = 5; }
				else if($total_marks >= 70) { $grade = 'A'; $point = 4; }
				else if($total_marks >= 60) { $grade = 'A-'; $point = 3.5; }
				else if($total_marks >= 50) { $grade = 'B'; $point = 3; }
				else if($total_marks >= 40) { $grade = 'C'; $point = 2; }
				else if($total_marks >= 33) { $grade = 'D'; $point = 1; }
				}else { array_push($single_fail, array($key=>'F','subject'=>$val));	}
					
				
				$data['subject_result'] .= '<td>'.$subject_name.'<br>CQ:'.$cq_mark.'<br>MCQ:'.$mcq_mark.'<br>Practical:'.$practical_mark.'<br> Total:'.$total_marks.'<br>Points:'.$point.'<br>Gread:'.$grade.'</td>';
				
				if (($subject_type == 'cwp4') || ($subject_type == 'cwtp4') || ($subject_type == 'ncwp4') || ($subject_type == 'ncwtp4')) {
					$point = $point - 2;
					if ($point < 0) { $point = 0; }
				}
				$total_point = @$total_point + $point;
			}
			
			$avg = $total_point/6 . "<br />";
			$data['point_result'] = ($avg>5) ? '5' : $avg;
			
			
			if(in_array_r('F', $single_fail)){ $data['grade_result'] = 'F'; $data['point_result'] = ''; }
			else {
			if($avg >= 5) { $grade = 'A+'; }
			else if($avg >= 4) { $grade = 'A'; $point = 4; }
			else if($avg >= 3.5) { $grade = 'A-'; }
			else if($avg >= 3) { $grade = 'B'; }
			else if($avg >= 2) { $grade = 'C'; }
			else if($avg >= 1) { $grade = 'D'; }
			else {$grade = 'F'; }
			$data['grade_result'] = $grade;
			}  
				   
				   
				   
				   
				$data['result_list'] .= '<tr><td>'.$row->roll_no.'</td>'.$data['subject_result'].'<td>'.sprintf ("%.2f", $data['point_result']).'</td><td>'.$data['grade_result'].'</td></tr>';   
				//$data['subject_result'] .= '<tr><td>'.$subject_name.'</td><td>'.$cq_mark.'</td><td>'.$mcq_mark.'</td><td>'.$practical_mark.'</td><td>'.$total_marks.'</td><td>'.$Point.'</td><td>'.$grade.'</td></tr>';
				   
				   
			   	}
			}else {
				 $data['list_result'] = '<p class="alert alert-info not_fount">No Exam Found</p>';	
			}
			


			$this->load->view('admin/exam/view_result_print', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	
	
	
}
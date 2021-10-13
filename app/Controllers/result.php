<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class result extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		//$this->load->library('form_validation');
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}
	}
	
	public function index()
	{	
		$data['page_title'] = 'Result';
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');
		$this->load->helper('student_functions_helper');
		$this->load->helper('settings_functions_helper');
		
		
		$notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($notice_list->num_rows() > 0)
		{
		   $data['list_notice'] = $notice_list->result();
		}else {
			$data['list_notice'] = 'No notice published';	
		}
		
		
		$internal_result_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (10) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($internal_result_list->num_rows() > 0)
		{
		   $data['list_result_internal'] = $internal_result_list->result();
		}else {
			 $data['list_result_internal'] = 'No Internal Result Published';	
		}
		
		
		$public_result_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (9) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($public_result_list->num_rows() > 0)
		{
		   $data['list_result_public'] = $public_result_list->result();
		}else {
			 $data['list_result_public'] = 'No Public Result Published';	
		}
		
		$circular_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (6) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($circular_list->num_rows() > 0)
		{
		   $data['list_carcular'] = $circular_list->result();
		}else {
			 $data['list_carcular'] = 'No Circular Published';	
		}
		
		
		$routine_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (7) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($routine_list->num_rows() > 0)
		{
		   $data['list_routine'] = $routine_list->result();
		}else {
			 $data['list_routine'] = 'No Routine Published';	
		}
		
		$holiday_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (8) ORDER BY `dwn_id` DESC LIMIT 0, 5");
		if ($holiday_list->num_rows() > 0)
		{
		   $data['list_holiday'] = $holiday_list->result();
		}else {
			 $data['list_holiday'] = 'No Holiday Notice Published';	
		}
		
		$data['dwn_path'] = base_url()."uploads/downloads/"; //$get_download;
		
		$data['head_teacher_name'] = $this->functions->show_widget('title', 10);
		$data['head_teacher_comment'] = $this->functions->show_widget('description', 10);
		$data['head_teacher_photo'] = $this->functions->show_widget_img(10, 150, 200);
		
		$data['chairman_name'] = $this->functions->show_widget('title', 5);
		$data['chairman_comment'] = $this->functions->show_widget('description', 5);
		$data['chairman_photo'] = $this->functions->show_widget_img(5, 150, 200);
		
		$data['important_links'] = $this->functions->show_widget('description', 6);
		
		$data['footer_widget_title'] = $this->functions->show_widget('title', 8);
		$data['footer_widget_description'] = $this->functions->show_widget('description', 8);
		
		$data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
		$data['footer_widget2_description'] = $this->functions->show_widget('description', 9);
		
		
		$data['check_user'] = '';
		if ($this->m_logged_in == true) {
			$data['check_user'] = $this->session->userdata('m_logged_in');
			$data['u_name'] = $this->session->userdata('u_name');

			$data['age'] = $this->session->userdata('age');
			if ($data['check_user'] == 1) {
			$data['u_id'] = $this->session->userdata('tec_id');
			}
			if ($data['check_user'] == 2) {
			$data['u_id'] = $this->session->userdata('std_id');
			}
		}
		
		$data['sidebar_left'] = $this->load->view('front/sidebar-left', $data, true);
		$data['sidebar_right'] = $this->load->view('front/sidebar-right', $data, true);
		
		
		$slider_list = $this->db->query("SELECT * FROM `slider_gallery` WHERE `type` = 'slider' ORDER BY `sl_id` ASC LIMIT 0, 10");
		if ($slider_list->num_rows() > 0)
		{
		   $data['list_slider'] = $slider_list->result();
		}else {
			 $data['list_slider'] = 'No Slider Added';	
		}
		$data['slider'] = $this->load->view('front/slider', $data, true);
		
		$data['check_user'] = $this->session->userdata('m_logged_in');
		
		if ($this->m_logged_in == true) {
		$data['log_url'] = 'member_form/logout_member.html';
		$data['log_title'] = 'Logout';
		}else {
		$data['log_url'] = 'member_form/login.html';
		$data['log_title'] = 'Login';
		}
		
		
		
		
		
		
		
		$data['subject_result'] = '';
		$msg = '';
		if (isset($_POST['result_search'])) {
		
		$this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
		$this->form_validation->set_rules('roll', 'Roll Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('exam', 'Exam', 'trim|required|xss_clean');
		$this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
		$this->form_validation->set_rules('group', 'Group', 'trim|required|xss_clean');
		if ($this->form_validation->run() == true) {
		$year = $this->input->post('year');
		$roll = $this->input->post('roll');
		$exm_id = $this->input->post('exam'); 
		$grp_id = $this->input->post('group'); 
		$cl_id = $this->input->post('class'); 
		
		$result_query = $this->db->query("SELECT * FROM `result`, `exam` WHERE `roll_no` = '$roll' AND `year` = '$year' AND `result`.`exm_id` = '$exm_id' AND `exam`.`class_id` = '$cl_id' AND `exam`.`grp_id` = '$grp_id' AND `result`.`exm_id` = `exam`.`exm_id`");
		$result_row = $result_query->row();
		
		if ($result_query->num_rows() > 0) {
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
		$data['point_result'] = $avg;
		
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
		}else {
			$msg = "No result found";
		}
		}else {
			$msg = validation_errors();
		}
		}
		
		$data['msg'] = $msg;
		
		$this->load->view('front/header', $data);
		$this->load->view('front/result', $data);
		$this->load->view('front/footer', $data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

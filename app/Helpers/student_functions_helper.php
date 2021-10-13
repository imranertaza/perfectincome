<?php

function religion_list($checked_id=0) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT * FROM `religion`";
	$q = $ci->db->query($sql);
	foreach ($q->result() as $rows) {
		if ($checked_id == $rows->rel_id) { $checked = 'checked="checked"'; }else { $checked = ''; }
		$output .= '<label><input type="radio" name="religion" value="'.$rows->rel_id.'" '.$checked.' />  '.  $rows->religion_name.'</label><br />';
	}
	print empty($output) ? "Not Set" : $output;
}


function class_list($sel_id=0) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT * FROM `classes`";
	$q = $ci->db->query($sql);
	foreach ($q->result() as $rows) {
		if ($sel_id == $rows->class_id) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$rows->class_id.'" '.$selected.' />  '.  $rows->class_name.'<br />';
	}
	print empty($output) ? "Not Set" : $output;
}


function group_list($grp_id=0) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT * FROM `class_group`";
	$q = $ci->db->query($sql);
	foreach ($q->result() as $rows) {
		if ($grp_id == $rows->grp_id) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$rows->grp_id.'" '.$selected.'>  '.  $rows->group_name.'</option>';
	}
	print empty($output) ? "Not Set" : $output;
}

function subject_type_list($stp_id=0) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT * FROM `sub_type`";
	$q = $ci->db->query($sql);
	foreach ($q->result() as $rows) {
		if ($stp_id == $rows->stp_id) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$rows->stp_id.'" '.$selected.'>  '.  $rows->sub_type_name.'</option>';
	}
	print empty($output) ? "Not Set" : $output;
}


function tech_subjects_list($grp_id=0, $class_id=0, $sub_id=0) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	print $sub_id;
	$sql = "SELECT * FROM `subject` WHERE `type` = '4 Subject' AND `class_id` = '$class_id' AND `grp_id` = '$grp_id'";
	$q = $ci->db->query($sql);
	foreach ($q->result() as $rows) {
		print $rows->sub_id;
		if ($sub_id == $rows->sub_id) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$rows->sub_id.'" '.$selected.'>  '.  $rows->name.'</option>';
	}
	print empty($output) ? "Not Set" : $output;
}


function get_married_status_student($std_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT `merried` FROM `students` WHERE `std_id` = '$std_id'";
	$q = $ci->db->query($sql);
	$row  = $q->row();
	if ($row->merried == 1) { $output = 'Single'; }
	if ($row->merried == 2) { $output = 'Married'; }
	return empty($output) ? "Not Set" : $output;
}


function get_gender_student($std_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT `sex` FROM `students` WHERE `std_id` = '$std_id'";
	$q = $ci->db->query($sql);
	$row  = $q->row();
	if ($row->sex == 1) { $output = 'Male'; }
	if ($row->sex == 2) { $output = 'Female'; }
	return empty($output) ? "Not Set" : $output;
}


function get_religion_student($std_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$sql = "SELECT `religion` FROM `students` WHERE `std_id` = '$std_id'";
	$q = $ci->db->query($sql);
	$row  = $q->row();
	
	$rel_id = $row->religion;
	$rel_info = "SELECT `religion_name` FROM `religion` WHERE `rel_id` = '$rel_id'";
	$find = $ci->db->query($rel_info);
	$get  = $find->row();
	return empty($get->religion_name) ? "Not Set" : $get->religion_name;
}



function get_class_student($std_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$sql = "SELECT `class_id` FROM `students` WHERE `std_id` = '$std_id'";
	$q = $ci->db->query($sql);
	$row  = $q->row();
	
	$class_id = $row->class_id;
	$class_info = "SELECT `class_name` FROM `classes` WHERE `class_id` = '$class_id'";
	$find = $ci->db->query($class_info);
	$get  = $find->row();
	return empty($get->class_name) ? "Not Set" : $get->class_name;
}


function count_student($class_id, $group_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT * FROM `students` WHERE `class_id` = '$class_id' AND `group_id` = '$group_id'";
	$q = $ci->db->query($sql);
	return $q->num_rows();
}


function exam_list($exm_id=0) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT * FROM `exam`";
	$q = $ci->db->query($sql);
	foreach ($q->result() as $rows) {
		if ($grp_id == $rows->exm_id) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$rows->exm_id.'" '.$selected.'>  '.  $rows->exam_name.'</option>';
	}
	print empty($output) ? "Not Set" : $output;
}







function get_username_byID($id){

    $table = DB()->table('users');
    $query = $table->where('ID',$id)-get();
	$rows = $query->getRow();
	if (!empty($rows->username)) {
		$username = $rows->username;
	}else {
		$username = 'None';	
	}
	return $username;
}


function get_hand_byID($id, $hand='l_t'){
    $table = DB()->table('Tree');
    $query = $table->select($hand)->where('u_id',$id)-get();
    $rows = $query->getRow();

	if (!empty($rows->$hand)) {
		$get_hand = $rows->$hand;
	}else {
		$get_hand = 0;	
	}
	return $get_hand;
}
	
	
	
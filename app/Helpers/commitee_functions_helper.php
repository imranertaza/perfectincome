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


function get_married_status_teacher($tec_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT `merried` FROM `commitee` WHERE `tec_id` = '$tec_id'";
	$q = $ci->db->query($sql);
	$row = $q->row_array();
	if ($row['merried'] == 1) { $output = 'Single'; }
	if ($row['merried'] == 2) { $output = 'Married'; }
	if (empty($output)) {
		return 'Not selected.';
	}else {
		return empty($output) ? "Not Set" : $output;
	}
}

function get_gender_teacher($tec_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$output = '';
	$sql = "SELECT `sex` FROM `commitee` WHERE `tec_id` = '$tec_id'";
	$q = $ci->db->query($sql);
	$row  = $q->row();
	if ($row->sex == 1) { $output = 'Male'; }
	if ($row->sex == 2) { $output = 'Female'; }
	if (empty($output)) {
		return 'Not selected.';
	}else {
		return empty($output) ? "Not Set" : $output;
	}
}


function get_religion_teacher($tec_id) {
	$ci =& get_instance();
	$ci->load->database();
	
	$sql = "SELECT `religion` FROM `commitee` WHERE `tec_id` = '$tec_id'";
	$q = $ci->db->query($sql);
	$row  = $q->row();
	
	$rel_id = $row->religion;
	$rel_info = "SELECT `religion_name` FROM `religion` WHERE `rel_id` = '$rel_id'";
	$find = $ci->db->query($rel_info);
	$get  = $find->row();
	if (empty($get->religion_name)) {
		return 'Not selected.';
	}else {
		return empty($get->religion_name) ? "Not Set" : $get->religion_name;
	}
}

?>
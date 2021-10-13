<?php

function check_userid($id, $table) {
	$ci =& get_instance();
	$ci->load->database();
	$query = $ci->db->query("SELECT `stockist_id` FROM `".$table."` WHERE `stockist_id` = '$id'");
	$rows = $query->num_rows();
	return ($rows > 0) ? TRUE : FALSE;
}
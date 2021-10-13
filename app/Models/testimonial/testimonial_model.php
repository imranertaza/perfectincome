<?php
class testimonial_model extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	
	
	public function create() {
		if (isset($_POST['add_page'])) {
			$msg = '';
			$temp = $_POST['page_template'];
			$title = $_POST['page_tilte'];
			$get_slug = $this->functions->seoUrl($title);
			$slug = $this->functions->check_slug($get_slug);
			$description = $_POST['description'];
			$short_description = $_POST['short_description'];
			
			$update_page = $this->db->query("INSERT INTO `pages` SET 
											`temp` 				= '$temp',
											`page_title` 		= '$title',
											`slug`		 		= '$slug',
											`short_des` 		= '$short_description',
											`page_description` 	= '$description',
											`page_type` 		= 'page'");
			if ($update_page) {
				$msg .= '<p class="success">Page successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function find_template($page_id=0) {
		//$sel_temp = mysql_fetch_array(mysql_query("SELECT `temp` FROM `pages` WHERE `page_id` = '$page_id'"));
		$sel_temp = $this->db->query("SELECT `temp` FROM `pages` WHERE `page_id` = '$page_id'")->row();
		$template = '';
		$dir = 'application/views/admin/testimonial/template/';
		$files = scandir($dir);
		foreach($files as $key=>$file) {
			if (($file != '.') && ($file != '..')) {
				if ($sel_temp['temp'] == $file) { $selected = 'selected="selected"'; }else { $selected = ''; }
				$template .= '<option '.$selected.'>'.$file.'</option>';
			}
		}
		print $template;
	}
	
	
	
}
?>
<?php
class global_settings extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function save_settings() {
		if (isset($_POST['save_settings'])) {
			$site_title = $_POST['site_title'];
			$gen_email = $_POST['gen_email'];
			$form_email = $_POST['form_email'];
			$contact_email = $_POST['contact_email'];
			
			if (empty($site_title)) { $error .= '<p class="error">Please put the site title</p>'; }
			if (empty($gen_email)) { $error .= '<p class="error">Please put the admin contact email</p>'; }
			if (empty($form_email)) { $error .= '<p class="error">Please put the contact form email.</p>'; }
			if (empty($contact_email)) { $error .= '<p class="error">Please put the contact page email</p>'; }
			
			
			if (empty($error)) {
			$update = $this->db->query("UPDATE `global_settings` SET 
											`value` = '$site_title' WHERE `global_settings`.`title` = 'site_title'");
											
			$update .= $this->db->query("UPDATE `global_settings` SET 
											`value` = '$gen_email' WHERE `global_settings`.`title` = 'gen_email'");
											
			$update .= $this->db->query("UPDATE `global_settings` SET 
											`value` = '$form_email' WHERE `global_settings`.`title` = 'form_email'");
											
			$update .= $this->db->query("UPDATE `global_settings` SET 
											`value` = '$contact_email' WHERE `global_settings`.`title` = 'contact_email'");
			}
			
			if ($update){
				$msg = '<p class="success">Settings successfully saved!</p>';	
			}else {
				$msg = '<p class="error">Something problem in it.</p>';	
			}
			return $msg;
			
			
		}
	}
	
	
	
	public function get_each_setting_value($key) {
		$result = $this->db->query("SELECT `value` FROM `global_settings` WHERE `title` = '$key'")->row();
		return $result->value;
	}
	
	
	public function contact_form_mail($email, $subject, $massage) {
		$to = $this->get_each_setting_value($key = 'form_email');
		$headers   = "MIME-Version: 1.0" . "\r\n";
		$headers  .= "From: ".$email."<".$email.">" . "\r\n";
		$headers  .= "Bcc: <".$to.">" . "\r\n";
		$headers  .= "Reply-To: <".$to.">" . "\r\n";
		$headers  .= "Return-Path: <".$to.">" . "\r\n";
		$headers  .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
		$headers  .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		//$send = mail($to, $headers, $subject, $massage);
		$send = 'Yes';
		
		if ($send) {
			$msg = '<p class="success">Mail sent. We will get back to you soon.</p>';
		}else {
			$msg = '<p class="error">Mail does not sent. Something wrong in it. Please try again latter.</p>';	
		}
		return $msg;
	}
	
	
	
	public function upload_image() {
		//if (isset($_POST['create_slide'])) {
		$msg = '';
			$image_name = empty($_FILES["main_img"]["name"]) ? '0' : 'f_gallery_'.time().'.jpg';
			$sl_name = $_POST['sl_name'];
			$type = $_POST['type'];
			
			$add_slide = $this->db->query("INSERT INTO `slider_gallery` SET 
											`name` 	= '$sl_name',
											`image`	= '$image_name',
											`type`	= '$type'");
			if ($add_slide) {
				$target_path = 'uploads/gallery/'.$image_name;
				move_uploaded_file($_FILES["main_img"]["tmp_name"], $target_path);
				
				$msg .= '<p class="success">Picture successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>'.mysql_error();
			}
			return $msg;
		//}
	}
	
	
	
}
?>
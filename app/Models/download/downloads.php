<?php
class downloads extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function download_list() {
		$sql =  $this->db->query("SELECT * FROM `downloads`");
		while($rows =  mysql_fetch_array($sql)) {
			$dwn_id = $rows['dwn_id'];
		?>
        <tr class="odd gradeX" id="download_<?php print $dwn_id; ?>">
            <td><?php print $rows['title']; ?></td>
            <td><?php print $rows['description']; ?></td>
            <td><?php print $rows['file']; ?></td>
            <td class="center">
            <?php if ($this->functions->hasPermission('edit_post') == true) { ?>
            <a href="<?php print base_url(); ?>download/edit_download/<?php print $dwn_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_post') == true) { ?>
            <a onclick="delete_download(<?php print $dwn_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	
	
	public function edit_download($dwn_id) {
		if (isset($_POST['edit_download'])) {
			
			// Compair with Old image and new image, Also deleteing old image from directory
			//$old_file = mysql_fetch_array(mysql_query("SELECT `file` FROM `downloads` WHERE `dwn_id` = '$dwn_id'"));
			$old_file = $this->db->query("SELECT `file` FROM `downloads` WHERE `dwn_id` = '$dwn_id'")->row();
			$old_f_file = $old_image['file'];
			
			$get_ext = pathinfo($_FILES["main_img"]["name"]);
			$ext = '.'.$get_ext['extension'];
			
			$file_name = empty($_FILES["file"]["name"]) ? $old_f_image : 'f_dwn_'.time().$ext;
			if (!empty($_FILES["file"]["name"])) {
				if (file_exists('uploads/downloads/'.$old_f_image)) {
					unlink('uploads/downloads/'.$old_f_image);
				}
			}
			
			$msg = '';
			$title = $_POST['title'];
			$description = $_POST['description'];
			
			$update_page = $this->db->query("UPDATE `downloads` SET 
											`title` 				= '$title', 
											`file`					= '$file_name',
											`description` 			= '$description' 
											 WHERE `downloads`.`dwn_id` = '$dwn_id'");
			if ($update_page) {
				
				$target_path = 'uploads/downloads/'.$file_name;
				move_uploaded_file($_FILES["file"]["tmp_name"], $target_path);
				
				$msg .= '<p class="success">Download successfully updated.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_download() {
			$msg = '';
			$title = $_POST['title'];
			
			$get_ext = pathinfo($_FILES["main_img"]["name"]);
			$ext = '.'.$get_ext['extension'];
			
			$file_name = empty($_FILES["file"]["name"]) ? '0' : 'f_dwn_'.time().$ext;
			$description = $_POST['description'];
			$b_code = $_POST['b_code'];
			
			$update_page = $this->db->query("INSERT INTO `downloads` SET 
											`title` 			= '$title',
											`b_code` 			= '$b_code',
											`description` 		= '$description',
											`file`				= '$file_name'");
			if ($update_page) {
				
				$target_path = 'uploads/downloads/'.$image_name;
				move_uploaded_file($_FILES["file"]["tmp_name"], $target_path);
				
				$msg .= '<p class="success">New Download successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
	}
}
?>
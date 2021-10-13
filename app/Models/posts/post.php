<?php
class post extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function post_list() {
		$sql =  $this->db->query("SELECT * FROM `pages` WHERE `page_type` = 'post'");
		while($rows =  mysql_fetch_array($sql)) {
			$page_id = $rows['page_id'];
		?>
        <tr class="odd gradeX" id="page_<?php print $page_id; ?>">
            <td><?php print $rows['page_id']; ?></td>
            <td><?php print $rows['page_title']; ?></td>
            <td><?php print $rows['short_des']; ?></td>
            <td class="center">
            <?php if ($this->functions->hasPermission('edit_post') == true) { ?>
            <a href="<?php print base_url(); ?>posts/edit_post/<?php print $page_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_post') == true) { ?>
            <a onclick="delete_page(<?php print $page_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	
	
	public function edit_post($page_id) {
		if (isset($_POST['edit_post'])) {
			
			// Compair with Old image and new image, Also deleteing old image from directory
			//$old_image = mysql_fetch_array(mysql_query("SELECT `f_image` FROM `pages` WHERE `page_id` = '$page_id'"));
			$old_image = $this->db->query("SELECT `f_image` FROM `pages` WHERE `page_id` = '$page_id'")->row();
			$old_f_image = $old_image['f_image'];
			$image_name = empty($_FILES["f_img"]["name"]) ? $old_f_image : 'f_post_'.time().'.jpg';
			if (!empty($_FILES["f_img"]["name"])) {
				if (file_exists('uploads/post_image/'.$old_f_image)) {
					unlink('uploads/post_image/'.$old_f_image);
				}
			}
			
			$msg = '';
			$title = $_POST['post_tilte'];
			$description = $_POST['description'];
			$short_description = $_POST['short_description'];
			$category = isset($_POST['Category']) ? $_POST['Category'] : 0;
			$cat_id = '';
			if (!empty($category)) {
				foreach($category as $key=>$val) {
					$cat_id .= $val.',';
				}
			}
			
			$update_page = $this->db->query("UPDATE `pages` SET 
											`cat_id` 				= '$cat_id',
											`page_title` 			= '$title', 
											`short_des` 			= '$short_description',
											`f_image`				= '$image_name',
											`page_description` 		= '$description' 
											WHERE `pages`.`page_id` = '$page_id'");
			if ($update_page) {
				
				$target_path = 'uploads/post_image/'.$image_name;
				move_uploaded_file($_FILES["f_img"]["tmp_name"], $target_path);
				
				$msg .= '<p class="success">Page successfully updated.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_post() {
		if (isset($_POST['add_post'])) {
			$msg = '';
			$title = $_POST['post_tilte'];
			$image_name = empty($_FILES["f_img"]["name"]) ? '0' : 'f_post_'.time().'.jpg';
			$description = $_POST['description'];
			$short_description = $_POST['short_description'];
			$category = isset($_POST['Category']) ? $_POST['Category'] : 0;
			$cat_id = '';
			if (!empty($category)) {
				foreach($category as $key=>$val) {
					$cat_id .= $val.',';
				}
			}
			
			$update_page = $this->db->query("INSERT INTO `pages` SET 
											`page_title` 		= '$title',
											`cat_id`			= '$cat_id',
											`short_des` 		= '$short_description',
											`page_description` 	= '$description',
											`f_image`			= '$image_name',
											`page_type` 		= 'post'");
			if ($update_page) {
				
				$target_path = 'uploads/post_image/'.$image_name;
				move_uploaded_file($_FILES["f_img"]["tmp_name"], $target_path);
				
				$msg .= '<p class="success">Page successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	
	public function view_post_image($page_id, $w, $h) {
		//$pro_image = mysql_fetch_array(mysql_query("SELECT `f_image` FROM `pages` WHERE `page_id` = '$page_id'"));
		$pro_image = $this->db->query("SELECT `f_image` FROM `pages` WHERE `page_id` = '$page_id'")->row();
		if (!empty($pro_image['f_image'])) {
			print '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/post_image/'.$pro_image['f_image'].'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}else {
			print '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/post_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}
	}
	
	
}
?>
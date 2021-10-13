<?php
class widget extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function widget_list() {
		$sql =  $this->db->query("SELECT * FROM `widget`");
		//while($rows =  mysql_fetch_array($sql)) {
			foreach ($sql->result() as $rows) {
			$w_id = $rows->w_id;
		?>
        <tr class="odd gradeX" id="widget_<?php print $w_id; ?>">
            <td><?php print $rows->title; ?></td>
            <td><?php print $rows->description; ?></td>
            <td><?php print $rows->b_code; ?></td>
            <td class="center">
            <?php if ($this->functions->hasPermission('edit_post') == true) { ?>
            <a href="<?php print base_url(); ?>widgets/edit_widget/<?php print $w_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_post') == true) { ?>
            <a onclick="delete_widget(<?php print $w_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	 
	
	public function edit_widget($w_id) {
		if (isset($_POST['edit_widget'])) {
			
			// Compair with Old image and new image, Also deleteing old image from directory
			//$old_image = mysql_fetch_array(mysql_query("SELECT `image` FROM `widget` WHERE `w_id` = '$w_id'"));
			$old_image = $this->db->query("SELECT `image` FROM `widget` WHERE `w_id` = '$w_id'")->row();
			$old_f_image = $old_image['image'];
				
			$error = '';
			if (empty($_FILES["f_img"]["name"])) { $image_name = $old_f_image; }
			else { 
			$get_ext = pathinfo($_FILES["f_img"]["name"]);
			$ext = '.'.$get_ext['extension'];
			
				if ($ext == '.jpg' || $ext == '.JPG' || $ext == '.JPEG' || $ext == '.JPG' || $ext == '.PNG' || $ext == '.png') {
				$image_name = 'f_wdgt_'.time().$ext;
				}else{
					$error .= '<p class="error">Image format does not support.</p>';
				}
			}
			
			$image_name = empty($_FILES["f_img"]["name"]) ? $old_f_image : 'f_wdgt_'.time().$ext;
			if (!empty($_FILES["f_img"]["name"])) {
				if (file_exists('uploads/widget_image/'.$old_f_image)) {
					unlink('uploads/widget_image/'.$old_f_image);
				}
			}
			
			$msg = '';
			$title = $_POST['title'];
			$description = $_POST['description'];
			$b_code = $_POST['b_code'];
			
			if (empty($error)) {
			$update_page = $this->db->query("UPDATE `widget` SET 
											`title` 				= '$title', 
											`b_code` 				= '$b_code',
											`image`					= '$image_name',
											`description` 			= '$description' 
											 WHERE `widget`.`w_id` = '$w_id'");
			if ($update_page) {
				
				//$target_path = 'uploads/widget_image/'.$image_name;
				//move_uploaded_file($_FILES["f_img"]["tmp_name"], $target_path);
				$config['upload_path'] = 'uploads/widget_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				$this->upload->do_upload('f_img');
				
				
				$msg .= '<p class="success">Page successfully updated.</p>';
			}
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_widget() {
		if (isset($_POST['add_widget'])) {
			$msg = '';
			$title = $_POST['title'];
			
			$get_ext = pathinfo($_FILES["f_img"]["name"]);
			$ext = '.'.$get_ext->extension;
			
			$image_name = empty($_FILES["f_img"]["name"]) ? '0' : 'f_wdgt_'.time().$ext;
			$description = $_POST['description'];
			$b_code = $_POST['b_code'];
			
			$update_page = $this->db->query("INSERT INTO `widget` SET 
											`title` 			= '$title',
											`b_code` 			= '$b_code',
											`description` 		= '$description',
											`image`				= '$image_name'");
			if ($update_page) {
				
				//$target_path = 'uploads/widget_image/'.$image_name;
				//move_uploaded_file($_FILES["f_img"]["tmp_name"], $target_path);
				$config['upload_path'] = 'uploads/widget_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				$this->upload->do_upload('main_img');
				
				$msg .= '<p class="success">Page successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	
	public function view_post_image($w_id, $w, $h) {
		$pro_image = $this->db->query("SELECT `image` FROM `widget` WHERE `w_id` = '$w_id'")->row();
		if (!empty($pro_image->image)) {
			print '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/widget_image/'.$pro_image['image'].'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}else {
			print '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/widget_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}
	}
	
	
}
?>
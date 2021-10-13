<?php
class student_function extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function student_list() {
		$sql =  $this->db->query("SELECT * FROM `students`");
		while($rows =  mysql_fetch_array($sql)) {
			$std_id = $rows['std_id'];
		?>
        <tr class="odd gradeX" id="std_<?php print $std_id; ?>">
            <td><?php print $rows['std_id']; ?></td>
            <td><?php print $this->student_function->view_student_image($std_id, 90, 90); ?></td>
            <td><?php print $rows['name']; ?></td>
            <td><?php 
			$description = htmlentities($rows['description']);
			print substr($description, 0, 150); ?></td>
            <td class="center">
            <a href="<?php print base_url(); ?>admin_area/student/view/<?php print $std_id; ?>.html" class="btn btn-primary take_margin" title="View"><i class="fa fa-fw"></i></a>
            <?php if ($this->functions->hasPermission('edit_std') == true) { ?>
            <a href="<?php print base_url(); ?>admin_area/student/edit_student/<?php print $std_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_std') == true) { ?>
            <a onclick="delete_product(<?php print $std_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	
	public function edit_student($std_id) {
		if (isset($_POST['edit_student'])) {
			
			// Compair with Old image and new image, Also deleteing old image from directory
			//$old_image = mysql_fetch_array(mysql_query("SELECT `main_image` FROM `students` WHERE `std_id` = '$std_id'"));
			$old_image = $this->db->query("SELECT `main_image` FROM `students` WHERE `std_id` = '$std_id'")->row();
			$old_f_image = $old_image['main_image'];
			
			$error = '';
			if (empty($_FILES["main_img"]["name"])) { $image_name = $old_f_image; }
			else { 
			$get_ext = pathinfo($_FILES["main_img"]["name"]);
			$ext = '.'.$get_ext['extension'];
			
				if ($ext == '.jpg' || $ext == '.JPG' || $ext == '.JPEG' || $ext == '.jpeg' || $ext == '.PNG' || $ext == '.png') {
				$image_name = 'f_pro_'.time().$ext;
				}else{
					$error .= '<p class="error">Image format does not support.</p>';
				}
			}
			
			if (!empty($_FILES["main_img"]["name"])) {
				if (file_exists('uploads/std_image/'.$old_f_image)) {
					unlink('uploads/std_image/'.$old_f_image);
				}
			}
			
			$msg = '';
			$name = isset($_POST['name']) ? $_POST['name'] : 0;
			$laddress = isset($_POST['laddress']) ? $_POST['laddress'] : 0;
			$paddress = isset($_POST['paddress']) ? $_POST['paddress'] : 0;
			$father = isset($_POST['father']) ? $_POST['father'] : 0;
			$mother = isset($_POST['mother']) ? $_POST['mother'] : 0;
			$merried = isset($_POST['m_status']) ? $_POST['m_status'] : 0;
			$gender = isset($_POST['gender']) ? $_POST['gender'] : 0;
			$religion = isset($_POST['religion']) ? $_POST['religion'] : 0;
			$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : 0;
			$password = isset($_POST['password']) ? $_POST['password'] : '12345';
			$dob = htmlentities(isset($_POST['dob']) ? $_POST['dob'] : 0);
			$description = isset($_POST['description']) ? $_POST['description'] : 0;
			$roll_no = htmlentities(isset($_POST['roll_no']) ? $_POST['roll_no'] : 0);
			$reg_no = htmlentities(isset($_POST['reg_no']) ? $_POST['reg_no'] : 0);
			$class_id = isset($_POST['class']) ? $_POST['class'] : 0;
			$group_id = isset($_POST['group']) ? $_POST['group'] : 0;
			$year = isset($_POST['year']) ? $_POST['year'] : 0;
			$season = isset($_POST['season']) ? $_POST['season'] : 0;
			
			
			if (empty($error)) {
			$update_pro = $this->db->query("UPDATE `students` SET 
											`name` = '$name', 
											`class_id` = '$class_id',
											`group_id` = '$group_id',
											`f_name` = '$father',
											`m_name` = '$mother',
											`dob` = '$dob',
											`roll_no` = '$roll_no',
											`reg_no` = '$reg_no',
											`mobile` = '$mobile',
											`pass` = '$password',
											`merried` = '$merried',
											`sex` = '$gender',
											`religion` = '$religion',
											`l_address` = '$laddress',
											`p_address` = '$paddress',
											`main_image`  = '$image_name',
											`description` = '$description',
											`ac_year` = '$year',
											`season` = '$season'
											WHERE `students`.`std_id` = '$std_id'");
											
			
			if ($update_pro) {
				//$target_path = 'uploads/std_image/'.$image_name;
				//move_uploaded_file($_FILES["main_img"]["tmp_name"], $target_path);
				
				$config['upload_path'] = 'uploads/std_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				$this->upload->do_upload('main_img');
				
				
				$msg .= '<p class="success">Successfully Updated.</p>';
			}
			}else {
				$msg .= '<p class="error">'.$error.'</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_student() {
		if (isset($_POST['add_pro'])) {
			$msg = '';
			
			
			$error = '';
			if (empty($_FILES["main_img"]["name"])) { $image_name = $old_f_image; }
			else { 
			$get_ext = pathinfo($_FILES["main_img"]["name"]);
			$ext = '.'.$get_ext['extension'];
			
				if ($ext == '.jpg' || $ext == '.JPG' || $ext == '.JPEG' || $ext == '.jpeg' || $ext == '.PNG' || $ext == '.png') {
				$image_name = 'f_pro_'.time().$ext;
				}else{
					$error .= '<p class="error">Image format does not support.</p>';
				}
			}
			
			$name = isset($_POST['name']) ? $_POST['name'] : 0;
			$laddress = isset($_POST['laddress']) ? $_POST['laddress'] : 0;
			$paddress = isset($_POST['paddress']) ? $_POST['paddress'] : 0;
			$father = isset($_POST['father']) ? $_POST['father'] : 0;
			$mother = isset($_POST['mother']) ? $_POST['mother'] : 0;
			$merried = isset($_POST['m_status']) ? $_POST['m_status'] : 0;
			$gender = isset($_POST['gender']) ? $_POST['gender'] : 0;
			$religion = isset($_POST['religion']) ? $_POST['religion'] : 0;
			$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : 0;
			$password = isset($_POST['password']) ? $_POST['password'] : '12345';
			$dob = htmlentities(isset($_POST['dob']) ? $_POST['dob'] : 0);
			$description = isset($_POST['description']) ? $_POST['description'] : 0;
			$roll_no = htmlentities(isset($_POST['roll_no']) ? $_POST['roll_no'] : 0);
			$reg_no = htmlentities(isset($_POST['reg_no']) ? $_POST['reg_no'] : 0);
			$class_id = isset($_POST['class']) ? $_POST['class'] : 0;
			$group_id = isset($_POST['group']) ? $_POST['group'] : 0;
			$year = isset($_POST['year']) ? $_POST['year'] : 0;
			$season = isset($_POST['season']) ? $_POST['season'] : 0;
			
			
			if (empty($error)) {
			$add_pro = $this->db->query("INSERT INTO `students` SET 
											`name` = '$name', 
											`class_id` = '$class_id',
											`group_id` = '$group_id',
											`f_name` = '$father',
											`m_name` = '$mother',
											`dob` = '$dob',
											`roll_no` = '$roll_no',
											`reg_no` = '$reg_no',
											`mobile` = '$mobile',
											`pass` = '$password',
											`merried` = '$merried',
											`sex` = '$gender',
											`religion` = '$religion',
											`l_address` = '$laddress',
											`p_address` = '$paddress',
											`main_image`	= '$image_name',
											`description` = '$description',
											`ac_year` = '$year',
											`season` = '$season'");
			}
			
			if ($add_pro) {
				//$target_path = 'uploads/std_image/'.$image_name;
				//move_uploaded_file($_FILES["main_img"]["tmp_name"], $target_path);
				
				$config['upload_path'] = 'uploads/std_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				$this->upload->do_upload('main_img');
				
				
				$msg .= '<p class="success">Student successfully added.</p>';
			}else {
				$msg .= '<p class="error">'.$error.'</p>';
			}
			return $msg;
		}
	}
	
	
	
	public function view_student_image($std_id, $w, $h) {
		$pro_image = $this->db->query("SELECT `photo` FROM `users` WHERE `ID` = '$std_id'")->row();
		if (!empty($pro_image->photo)) {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/user_image/'.$pro_image->photo.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}else {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/user_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}
	}
	
	
	
	
	
}
?>
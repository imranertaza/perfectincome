<?php
class commitee_function extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function commitee_list() {
		$sql =  $this->db->query("SELECT * FROM `commitee`");
		while($rows =  mysql_fetch_array($sql)) {
			$tec_id = $rows['tec_id'];
		?>
        <tr class="odd gradeX" id="tec_<?php print $tec_id; ?>">
            <td><?php print $rows['tec_id']; ?></td>
            <td><?php print $this->teacher_function->view_teacher_image($tec_id, 90, 90); ?></td>
            <td><?php print $rows['name']; ?></td>
            <td><?php print substr($rows['description'], 0, 150); ?></td>
            <td class="center">
            <a href="<?php print base_url(); ?>admin_area/teacher/view/<?php print $tec_id; ?>.html" class="btn btn-primary take_margin" title="View"><i class="fa fa-fw"></i></a>
            <?php if ($this->functions->hasPermission('edit_tec') == true) { ?>
            <a href="<?php print base_url(); ?>admin_area/teacher/edit_teacher/<?php print $tec_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_tec') == true) { ?>
            <a onclick="delete_teacher(<?php print $tec_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	
	public function edit_commitee($tec_id) {
		if (isset($_POST['edit_Member'])) {
			
			// Compair with Old image and new image, Also deleteing old image from directory
			//$old_image = mysql_fetch_array(mysql_query("SELECT `main_image` FROM `commitee` WHERE `tec_id` = '$tec_id'"));
			$old_image = $this->db->query("SELECT `main_image` FROM `commitee` WHERE `tec_id` = '$tec_id'")->row();
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
			
			
			if ((!empty($_FILES["main_img"]["name"])) and (!empty($old_f_image))) {
				if (file_exists('uploads/tec_image/'.$old_f_image)) {
					unlink('uploads/tec_image/'.$old_f_image);
				}
			}
			
			$msg = '';
			
			$name = isset($_POST['name']) ? $_POST['name'] : 0;
			$designation = isset($_POST['designation']) ? $_POST['designation'] : 0;
			$index_no = isset($_POST['index_no']) ? $_POST['index_no'] : 0;
			$e_qualification = isset($_POST['e_qualification']) ? $_POST['e_qualification'] : 0;
			$joining_date = isset($_POST['joining_date']) ? $_POST['joining_date'] : 0;
			$experience = isset($_POST['experience']) ? $_POST['experience'] : 0;
			$salary_details = isset($_POST['salary_details']) ? $_POST['salary_details'] : 0;
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
			
			if (empty($error)) {
			$update_pro = $this->db->query("UPDATE `commitee` SET 
											`name` = '$name', 
											`designation` = '$designation', 
											`index` = '$index_no', 
											`e_qualification` = '$e_qualification', 
											`joining_date` = '$joining_date', 
											`experience` = '$experience', 
											`salary_details` = '$salary_details', 
											`f_name` = '$father',
											`m_name` = '$mother',
											`dob` = '$dob',
											`mobile` = '$mobile',
											`pass` = '$password',
											`merried` = '$merried',
											`sex` = '$gender',
											`religion` = '$religion',
											`l_address` = '$laddress',
											`p_address` = '$paddress',
											`main_image`  = '$image_name',
											`description` = '$description'
											WHERE `commitee`.`tec_id` = '$tec_id'");
			}
			
			if ($update_pro) {
				//$target_path = 'uploads/tec_image/'.$image_name;
				//move_uploaded_file($_FILES["main_img"]["tmp_name"], $target_path);
				
				$config['upload_path'] = 'uploads/tec_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				//$this->upload->initialize($config);
				$this->upload->do_upload('main_img');
				//$data['upload_data'] = $this->upload->data();
				
				$msg .= '<p class="success">Updated Successfully.</p>';
			}else {
				$msg .= '<p class="error">'.$error.'</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_commitee() {
		if (isset($_POST['add_pro'])) {
			$msg = '';
			
			$error = '';
			if (empty($_FILES["main_img"]["name"])) { $image_name = ''; }
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
			$designation = isset($_POST['designation']) ? $_POST['designation'] : 0;
			$index_no = isset($_POST['index_no']) ? $_POST['index_no'] : 0;
			$e_qualification = isset($_POST['e_qualification']) ? $_POST['e_qualification'] : 0;
			$joining_date = isset($_POST['joining_date']) ? $_POST['joining_date'] : 0;
			$experience = isset($_POST['experience']) ? $_POST['experience'] : 0;
			$salary_details = isset($_POST['salary_details']) ? $_POST['salary_details'] : 0;
			$type = isset($_POST['type']) ? $_POST['type'] : "teacher";
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
			
			if (empty($error)) {
			$add_pro = $this->db->query("INSERT INTO `commitee` SET 
											`name` = '$name', 
											`designation` = '$designation', 
											`index` = '$index_no', 
											`e_qualification` = '$e_qualification', 
											`joining_date` = '$joining_date', 
											`experience` = '$experience', 
											`salary_details` = '$salary_details', 
											`f_name` = '$father',
											`m_name` = '$mother',
											`dob` = '$dob',
											`mobile` = '$mobile',
											`pass` = '$password',
											`merried` = '$merried',
											`sex` = '$gender',
											`religion` = '$religion',
											`l_address` = '$laddress',
											`p_address` = '$paddress',
											`main_image`	= '$image_name',
											`description` = '$description',
											`type` = '$type'");
			}
			if ($add_pro) {
				//$target_path = 'uploads/tec_image/'.$image_name;
				//move_uploaded_file($_FILES["main_img"]["tmp_name"], $target_path);
				
				$config['upload_path'] = 'uploads/tec_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				//$this->upload->initialize($config);
				$this->upload->do_upload('main_img');
				//$data['upload_data'] = $this->upload->data();
				
				$msg .= '<p class="success">Successfully added.</p>';
			}else {
				$msg .= '<p class="error">'.$error.'</p>';
			}
			return $msg;
		}
	}
	
	
	
	public function view_commitee_image($tec_id, $w, $h) {
		//f$pro_image = mysql_fetch_array(mysql_query("SELECT `main_image` FROM `commitee` WHERE `tec_id` = '$tec_id'"));
		$pro_image = $this->db->query("SELECT `main_image` FROM `commitee` WHERE `tec_id` = '$tec_id'")->row();
		if (!empty($pro_image['main_image'])) {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/tec_image/'.$pro_image['main_image'].'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}else {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/tec_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}
	}
	
	
	
	
	
}
?>
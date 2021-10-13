<?php
class class_mod extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function class_list() {
		$sql =  $this->db->query("SELECT * FROM `classes`");
		while($rows =  mysql_fetch_array($sql)) {
			$class_id = $rows['class_id'];
		?>
        <tr class="odd gradeX" id="class_<?php print $class_id; ?>">
            <td><?php print $class_id ?></td>
            <td><?php print $rows['class_name']; ?></td>
            <td class="center">
            <?php if ($this->functions->hasPermission('edit_class') == true) { ?>
            <a href="<?php print base_url(); ?>classes/edit_class/<?php print $class_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_class') == true) { ?>
            <a onclick="delete_class(<?php print $class_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	
	public function edit_class($class_id) {
		if (isset($_POST['edit_class'])) {
			$msg = '';
			$class_name = $_POST['class_name'];
			
			$update_category = $this->db->query("UPDATE `classes` SET 
											`class_name` = '$class_name'
											WHERE `classes`.`class_id` = '$class_id'");
			if ($update_category) {
				$msg .= '<p class="success">Color successfully updated.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_class() {
		if (isset($_POST['add_class'])) {
			$msg = '';
			$class_name = $_POST['class_name'];
			
			$add_class = $this->db->query("INSERT INTO `classes` SET 
											`class_name` = '$class_name'");
			if ($add_class) {
				$msg .= '<p class="success">Class successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	
}
?>
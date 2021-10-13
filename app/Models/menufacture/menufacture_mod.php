<?php
class menufacture_mod extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function category_list() {
		$sql =  $this->db->query("SELECT * FROM `menufacture`");
		//while($rows =  mysql_fetch_array($sql))		 {
			foreach ($sql->result() as $rows) {
			$men_id = $rows->men_id;
		?>
        <tr class="odd gradeX" id="cat_<?php print $men_id; ?>">
            <td><?php print $men_id ?></td>
            <td><?php print $rows->brand_name; ?></td>
            <td class="center">
            <?php if ($this->functions->hasPermission('edit_category') == true) { ?>
            <a href="<?php print base_url(); ?>menufacture/edit/<?php print $men_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_category') == true) { ?>
            <a onclick="delete_mnu(<?php print $men_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	
	public function edit_category($cat_id) {
		if (isset($_POST['edit_category'])) {
			$msg = '';
			$cat_name = $_POST['menu_name'];
			
			
			$update_category = $this->db->query("UPDATE `menufacture` SET 
											`brand_name` = '$cat_name'
											
											WHERE `menufacture`.`men_id` = '$cat_id'");
			if ($update_category) {
				$msg .= '<p class="success">Category successfully updated.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_menufactur() {
		if (isset($_POST['add_menufacture'])) {
			$msg = '';
			$menu_name = $_POST['menu_name'];
			
			
			$add_menufactur = $this->db->query("INSERT INTO `menufacture` SET 
											`brand_name` = '$menu_name'");
											
											
			if ($add_menufactur) {
				$msg .= '<p class="success">Menufactur successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function category_option_list($sel=0) {
		$category = $this->db->query("SELECT * FROM `Category`");
		while($category_list = mysql_fetch_array($category)) {
			if ($category_list['cat_id'] == $sel) { $selected = 'selected="selected"'; }else { $selected = ''; }
			print '<option value="'.$category_list['cat_id'].'" '.$selected.'>'. $category_list['cat_name'].'</option>';
		}
	}
	
	
	
}
?>
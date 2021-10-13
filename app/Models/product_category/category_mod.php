<?php
class category_mod extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function category_list() {
		$sql =  $this->db->query("SELECT * FROM `product_cat`");
		//while($rows = $sql->rows()) {
			foreach ($sql->result() as $rows){
			$pro_cat_id = $rows->cat_id;
		?>
        <tr class="odd gradeX" id="cat_<?php print $pro_cat_id; ?>">
            <td><?php print $pro_cat_id ?></td>
            <td><?php print $rows->cat_name; ?></td>
            <td class="center">
            <?php if ($this->functions->hasPermission('edit_category') == true) { ?>
            <a href="<?php print base_url(); ?>product_cat/edit/<?php print $pro_cat_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_category') == true) { ?>
            <a onclick="delete_pro_cat(<?php print $pro_cat_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php }
	}
	
	public function edit_category($cat_id) {
		if (isset($_POST['edit_category'])) {
			$msg = '';
			$cat_name = $_POST['cat_name'];
			$perent_id = $_POST['perent'];
			
			$update_category = $this->db->query("UPDATE `product_cat` SET 
											`cat_name` = '$cat_name',
											`perent_id` = '$perent_id'
											WHERE `product_cat`.`cat_id` = '$cat_id'");
			if ($update_category) {
				$msg .= '<p class="success">Category successfully updated.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_category() {
		if (isset($_POST['add_category'])) {
			$msg = '';
			$cat_name = $_POST['cat_name'];
			$perent_id = $_POST['perent'];
			
			$add_category = $this->db->query("INSERT INTO `product_cat` SET 
											`cat_name` = '$cat_name',
											`perent_id` = '$perent_id'");
			if ($add_category) {
				$msg .= '<p class="success">Category successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function category_option_list($sel=0) {
		$category = $this->db->query("SELECT * FROM `product_cat`");	
		//while($category_list = mysql_fetch_array($Category)) {
		foreach ($category->result() as $rows)
		{	
			if ($category_list['cat_id'] == $sel) { $selected = 'selected="selected"'; }else { $selected = ''; }
			print '<option value="'.$category_list['cat_id'].'" '.$selected.'>'. $category_list['cat_name'].'</option>';
		}
	}
	
	
	
}
?>
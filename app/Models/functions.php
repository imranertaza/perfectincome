<?php
class functions extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function role_list() {
		$q =  $this->db->query("SELECT * FROM `roles` ORDER BY  `ID` ASC");
        foreach ($q->result() as $rows) {
		?>
        <option value="<?php print $rows->ID; ?>"><?php print $rows->roleName; ?></option>
        <?php
		}
	}
	
	
	
	public function already_registered($email) {
		//$count =  mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `email` = '$email'"));
		$count = $this->db->query("SELECT * FROM `users` WHERE `email` = '$email'")->num_rows();
		if ($count) {
			$already = 1;
		}else { $already = 0; }
		return $already;
	}
	
	
	public function permission_list() {
		//$sql =  $this->db->query("SELECT * FROM `permissions` ORDER BY `group_id`");
		$sql = $this->db->query("SELECT * FROM `permissions` ORDER BY `group_id`");
		while($permission =  $sql->result()) {
		?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="permission[]" value="<?php print $permission['ID']; ?>"><?php print $permission['permName']; ?>
            </label>
        </div>
        <?php
		}
	}
	
	
	public function check_has_permission($role_id, $permission_id) {
		//$get_permissions = mysql_num_rows(mysql_query("SELECT * FROM `role_perms` WHERE `roleID` = '$role_id' AND `permID` = '$permission_id' AND `value` = 1"));
		
		$get_permissions = $this->db->query("SELECT * FROM `role_perms` WHERE `roleID` = '$role_id' AND `permID` = '$permission_id' AND `value` = 1")->num_rows();
		
		if ($get_permissions > 0) {
			return true;
		}else {
			return false;	
		}
	}
	
	
	public function permission_list_edited($role_id) {
		$sql =  $this->db->query("SELECT * FROM `permissions`");
		//while($permission = mysql_fetch_array($sql)) {
			foreach ($sql->result() as $rows) {
			$perm_id = $permission->ID;
		?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="permission[]" value="<?php print $permission->ID; ?>" <?php if ($this->check_has_permission($role_id, $perm_id) == true) { print 'checked="checked"'; }?>>
				<?php print $permission['permName']; ?>
            </label>
        </div>
        <?php
		}
	}
	
	
	public function duplicate_role_name($role_name) {
		//$count =  mysql_num_rows(mysql_query("SELECT * FROM `roles` WHERE `roleName` = '$role_name'"));
		$count = $this->db->query("SELECT * FROM `roles` WHERE `roleName` = '$role_name'")->num_rows();
		if ($count) {
			$already = 1;
		}else { $already = 0; }
		return $already;
	}
	
	
	public function duplicate_perm_name($perm_name) {
		//$count =  mysql_num_rows(mysql_query("SELECT * FROM `permissions` WHERE `permName` = '$perm_name'"));
		$count = $this->db->query("SELECT * FROM `permissions` WHERE `permName` = '$perm_name'")->num_rows();
		if ($count) {
			$already = 1;
		}else { $already = 0; }
		return $already;
	}
	
	public function duplicate_perm_key($perm_key) {
		//$count =  mysql_num_rows(mysql_query("SELECT * FROM `permissions` WHERE `permKey` = '$perm_key'"));
		$count = $this->db->query("SELECT * FROM `permissions` WHERE `permKey` = '$perm_key'")->num_rows();
		if ($count) {
			$already = 1;
		}else { $already = 0; }
		return $already;
	}
	
	
	public function user_role_by_id($role_id, $colum) {
		$user_role =  $this->db->query("SELECT `$colum` FROM `roles` WHERE `ID` = '$role_id'")->row();
		$role_name = $user_role->$colum;
		return $role_name;
	}
	
	public function get_user_role($user_id) {
		$user_role =  $this->db->query("SELECT `roleID` FROM `user_roles` WHERE `userID` = '$user_id'")->row();
		$user_role =  $this->db->query("SELECT * FROM `user_roles` WHERE `userID` = '$user_id'")->row();
		$role_id = $user_role->roleID;
		$role_name = $this->user_role_by_id($role_id, $colum='roleName');
		return $role_name;
	}

	public function get_user_role_by_userid($user_id, $colum){
		$user_role =  $this->db->query("SELECT `$colum` FROM `user_roles` WHERE `userID` = '$user_id'")->row();
		$role_id = $user_role->$colum;
		return $role_id;
	}
	
	public function hasPermission($permKey){
		$user_id = $this->session->userdata('user_id');
		$get_permission_id  = $this->db->query("SELECT `ID` FROM `permissions` WHERE `permKey` = '$permKey'")->row();
		$permission_id = $get_permission_id->ID;
		$role_id = $this->get_user_role_by_userid($user_id, 'roleID');
		$get_permissions = $this->db->query("SELECT * FROM `role_perms` WHERE `roleID` = '$role_id' AND `permID` = '$permission_id' AND `value` = 1")->num_rows();
		if ($get_permissions > 0) {
			return true;
		}else {
			return false;
		}
	}
	
	
	
	public function count_rows_table($table) {
		//$cycle_list = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `Rows` FROM `$table`"));
		$cycle_list = $this->db->query("SELECT COUNT(*) AS `Rows` FROM `$table`")->row();
		return $cycle_list['Rows'];
	}
	
	public function count_role_user($role) {
		//$admin = mysql_num_rows(mysql_query("SELECT * FROM `user_roles` WHERE `roleID` = '$role' GROUP BY `userID`"));
		$admin = $this->db->query("SELECT * FROM `user_roles` WHERE `roleID` = '$role' GROUP BY `userID`")->num_rows();
		return $admin;
	}
	
	
	public function select_page_by_id($column, $page_id) {
		//$page_detail = mysql_fetch_array(mysql_query("SELECT `$column` FROM `pages` WHERE `page_id` = '$page_id'"));
		$page_detail = $this->db->query("SELECT `$column` FROM `pages` WHERE `page_id` = '$page_id'")->row();
		return $page_detail[$column];
	}
	
	public function category_list($link) {
		$category = $this->db->query("SELECT * FROM `Category`");
		while($category_list = mysql_fetch_array($category)) {
			print '<li><a href="'.$link/$category_list['cat_id'].'"'.$category_list['cat_name'].'</li>';
		}
	}
	
	/*public function category_checkbox($parent=0, $step=0) {
		$Category = mysql_query("SELECT * FROM `Category` WHERE `perent_id` = '$parent'");
		$space = '';
		$i = 0;
		while ($i < $step) { $space .= ' -- '; $i++; }
		
		print '<ul class="Tree" id="Tree">';
		while($category_list = mysql_fetch_array($Category)) {
			$parent = $category_list['cat_id'];
			print '<li><label>'.$step.'<input type="checkbox" name="Category" value="'.$category_list['cat_id'].'">'.' '. $category_list['cat_name'].'</label>';
			$step++;
			$this->category_checkbox($parent, $step);
		}
		print '</li></ul>';
	}*/
	
	
	
	
	public function category_checkbox($parent=0, $sel=0) {
		$category = $this->db->query("SELECT * FROM `Category` WHERE `perent_id` = '$parent'")->result();
		$selected = explode(',', $sel);
		$output = '<ul class="Tree" id="Tree">';
		foreach($category as $category_list){
			if (in_array($category_list->cat_id, $selected)) { $checked = 'checked="checked"'; }else { $checked = ''; }
			$parent = $category_list->cat_id;
            $output .= '<li><label><input type="checkbox" '.$checked.' name="Category[]" value="'.$category_list['cat_id'].'">'.' '. $category_list->cat_name.'</label>';
			$this->category_checkbox($parent, $sel);
		}
        $output .= '</li></ul>';
	    return $output;
	}
	
	
	
	
	public function view_student_image($std_id, $w, $h) {
		//$pro_image = mysql_fetch_array(mysql_query("SELECT `main_image` FROM `students` WHERE `std_id` = '$std_id'"));
		$pro_image = $this->db->query("SELECT `main_image` FROM `students` WHERE `std_id` = '$std_id'")->row();
		if (!empty($pro_image['main_image'])) {
			print '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/std_image/'.$pro_image['main_image'].'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}else {
			print '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/std_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}
	}
	
	
	public function show_widget($col, $w_id) {
        $table = DB()->table('widget');
        $sql = $table->select($col)->where('w_id',$w_id)->get();
		$widget_output = $sql->getRow();
		$result = $widget_output->$col;
		return $result;
	}
	
	public function show_widget_img($w_id, $w, $h) {
		//$widget_output = mysql_fetch_array(mysql_query("SELECT * FROM `widget` WHERE `w_id` = '$w_id'"));
		$widget_output = $this->db->query("SELECT * FROM `widget` WHERE `w_id` = '$w_id'")->row();
		$result = '<img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/widget_image/'.$widget_output['image'].'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" alt="'.$widget_output['title'].'" />';
		return $result;
	}
	
	public function seoUrl($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	
	public function check_slug($ck_slug, $i=1) {
        $i = 1;
		$query = $this->db->query("SELECT `slug` FROM `pages` WHERE `slug` = '$ck_slug'");
        $check_it = $query->num_rows();
        if ($check_it==0) {
			return $ck_slug;
		}else{
			$ck_slug = $ck_slug.$i;
			$i++;
			return $this->check_slug($ck_slug, $i);
		}
	}
	
	/************** Important for cms end ***************/
	
	public function view_image($sl_id, $w, $h) {
		//$image = mysql_fetch_array(mysql_query("SELECT `image` FROM `slider_gallery` WHERE `sl_id` = '$sl_id'"));
		$image = $this->db->query("SELECT `image` FROM `slider_gallery` WHERE `sl_id` = '$sl_id'")->row();
		if (!empty($image['image'])) {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/gallery/'.$image['image'].'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}else {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/gallery/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}
	}
	
	
}
?>
<?php
class role_add_list extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function role_list() {
		$sql =  $this->db->query("SELECT * FROM `roles`");
		$i =1; 
		//while($rows =  mysql_fetch_array($sql)) {
			foreach ($sql->result() as $rows) {
		?>
        <tr class="odd gradeX">
            <td><?php print $i; ?></td>
            <td><?php print $rows->roleName; ?></td>
            <td><?php print $rows->role_description; ?></td>
            <td>
            <?php if ($this->functions->hasPermission('edit_role') == true) { ?>
            <a href="<?php echo base_url(); ?>role/edit_role/<?php print $rows->ID; ?>/" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <a href="<?php echo base_url(); ?>role/users_role_list/?do=del&id=<?php print $rows->ID; ?>" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></a></td>
        </tr>
        <?php
		$i++;
		}
	}
	
	public function add_role() {
		if (isset($_POST['add_role'])) {
			$add_role = '';
			$error = '';
			$success = '';
			$role_name	= $_POST['role_name'];
			$role_des		= $_POST['role_des'];
			@$permission = $_POST['permission'];
			
			if (empty($role_name)) { $error .= '<p class="error">Please put the role name</p>'; }
			if (empty($role_des)) { $error .= '<p class="error">Please put the role description</p>'; }
			if (empty($permission)) { $error .= '<p class="error">Please set some permission for the role</p>'; }
			
			if ($this->functions->duplicate_role_name($role_name) == 1) { $error .= '<p class="error">This name already used.</p>'; }
			
			if (empty($error)) { 
			$perms = $this->db->query("INSERT INTO `roles` SET 
														`roleName` = '$role_name', 
														`role_description` = '$role_des'");
														
			$insert_permid = mysql_insert_id();
			$current_time = date('Y-M-D h:m:s');
			
			foreach($permission as $key=>$value) {
			$role_perms = $this->db->query("INSERT INTO `role_perms` SET 
																	`roleID` = '$insert_permid',
																	`permID` = '$value',
																	`value`	 = '1',
																	`addDate` = '$current_time'");
			}
																
			
			if ($perms) {											 
				$success .= '<p class="success">Role added successfully!</p>'; 
			}else { $error .= 'There are someting internal problem.'; }
			}
			
			print $error.$success;
		}
	}
	
	
	/*public function add_perms() {
		if (isset($_POST['add_permission'])) {
			$error = '';
			$success = '';
			$perm_name	= $_POST['perm_name'];
			$perm_key	= $_POST['perm_key'];
			
			if (empty($perm_name)) { $error .= '<p class="error">Please put the permission name</p>'; }
			if (empty($perm_key)) { $error .= '<p class="error">Please put the permission key</p>'; }
			
			if ($this->functions->duplicate_perm_name($perm_name) == 1) { $error .= '<p class="error">This name already used.</p>'; }
			if ($this->functions->duplicate_perm_key($perm_key) == 1) { $error .= '<p class="error">This key already used.</p>'; }
			
			if (empty($error)) { 
			$perms = mysql_query("INSERT INTO `permissions` SET 
														`permKey` = '$perm_key', 
														`permName` = '$perm_name'");
														
			
			if ($perms) {											 
				$success .= '<p class="success">Permission added successfully!</p>'; 
			}else { $error .= 'There are someting internal problem.'; }
			}
			
			print $error.$success;
		}
	}*/
	
	
	public function reset_all_permission($role_id) {
		$reset = $this->db->query("UPDATE `role_perms` SET `value` = '0' WHERE `role_perms`.`roleID` = '$role_id'");
		if ($reset) {
			return true;
		}else {
			return false;
		}
	}
	
	
	public function edit_role($role_id) {
		if (isset($_POST['edit_role'])) {
			$add_role = '';
			$error = '';
			$success = '';
			$role_name	= $_POST['role_name'];
			$role_des	= $_POST['role_des'];
			@$permission = $_POST['permission'];
			
			
			if (empty($role_name)) { $error .= '<p class="error">Please put the role name</p>'; }
			if (empty($role_des)) { $error .= '<p class="error">Please put the role description</p>'; }
			if (empty($permission)) { $error .= '<p class="error">Please set some permission for the role</p>'; }
			
			if (empty($error)) { 
			$perms = $this->db->query("UPDATE `roles` SET 
										`roleName` = '$role_name', 
										`role_description` = '$role_des'
										WHERE `ID` = '$role_id'");
										
			
			$current_time = date('Y-M-D h:m:s');
			
			$this->reset_all_permission($role_id);
			
			foreach($permission as $key=>$value) {
				
				$sql = "SELECT * FROM `role_perms` WHERE `roleID` = '$role_id' AND `permID` = '$value'";
				//$permission_exist = mysql_num_rows(mysql_query($sql));
				$permission_exist = $this->db->query($sql)->num_rows();
				if ($permission_exist > 0) {
					
					$sql = "UPDATE `role_perms` SET 
															`roleID` = '$role_id',
															`permID` = '$value',
															`value`	 = '1',
															`addDate` = '$current_time'
															WHERE `roleID` = '$role_id' AND `permID` = '$value'";
					$role_perms = mysql_query($sql);
														
				}else {
					$role_perms = mysql_query("INSERT INTO `role_perms` SET 
														`roleID` = '$role_id',
														`permID` = '$value',
														`value`	 = '1',
														`addDate` = '$current_time'");
				}
			
			}
			
																
			
			if ($perms || $role_perms) {											 
				$success 	.= '<p class="success">Updated successfully!</p>'; 
			}else { $error 	.= 'There are someting internal problem.'; }
			}
			
			return $error.$success;
		}
	}
	
	
	
}
?>
<?php
class user_model extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function user_list() {
		$sql =  $this->db->query("SELECT * FROM `users`,`user_roles` WHERE `users`.`ID`= `user_roles`.`userID` AND `user_roles`.`roleID` IN(1,2,3)");
		$i = 1;
		//while($rows =  mysql_fetch_array($sql)) {
			foreach ($sql->result() as $rows) {
			$user_id = $rows->ID;
		?>
        <tr class="odd gradeX">
            <td><?php print $i; ?></td>
            <td><?php print $rows->username; ?></td>
            <td><?php print $rows->email; ?></td>
            <td><?php print $this->functions->get_user_role($user_id); ?></td>
            <td>
            <?php if ($this->functions->hasPermission('edit_user') == true) { ?>
            <a href="<?php print base_url(); ?>user/edit_user/<?php print $rows->ID; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <a href="<?php print base_url(); ?>user/users_list/?do=del&id=<?php print $rows->ID; ?>" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></a></td>
        </tr>
        <?php
		$i++;
		}
	}
	
	
	public function add_users() {
		if (isset($_POST['add_user'])) {
			$registration = '';
			$error = '';
			$success = '';
			$username 	= $_POST['username'];
			$email 			= $_POST['email'];
			$pass 			= md5($_POST['pass']);
			$con_pass 	= md5($_POST['con_pass']);
			$role 	= $_POST['role'];
			
			if (empty($username)) { $error .= '<p class="error">Please put the username</p>'; }
			if (empty($email)) { $error .= '<p class="error">Please put the email</p>'; }
			if (empty($pass)) { $error .= '<p class="error">Please put the pass</p>'; }
			if (empty($con_pass)) { $error .= '<p class="error">Please put the confirm password</p>'; }
			
			if ($pass != $con_pass) { $error .= '<p class="error">Both password doesnot match</p>'; }

			if ($this->functions->already_registered($email) == 1) { $error .= '<p class="error">Sorry! This email is already used.</p>'; }
			
			if (empty($error)) { 
			$registration = $this->db->query("INSERT INTO `users` SET 
														`username` = '$username', 
														`email` = '$email',  
														`password` = '$pass'");
														
			$insert_userid = mysql_insert_id();
			$current_time = date('Y-M-D h:m:s');
			$user_roles = $this->db->query("INSERT INTO `user_roles` SET 
																	`userID` = '$insert_userid',
																	`roleID` = '$role',
																	`addDate` = '$current_time'");
																
			
			if ($registration) {											 
				$success .= '<p class="success">Registration successfully!</p>'; 
			}else { $error .= 'There are someting internal problem.'; }
			}
			
			print $error.$success;
		}
	}
	
	
	
	public function edit_user($user_id) {
		if (isset($_POST['edit_user'])) {
			$registration = '';
			$error = '';
			$success = '';
			$username 		= $_POST['username'];
			$email 			= $_POST['email'];
			$pass 			= md5($_POST['pass']);
			$con_pass 		= md5($_POST['con_pass']);
			$role 			= $_POST['role'];
			
			if (empty($username)) { $error .= '<p class="error">Please put the username</p>'; }
			if (empty($email)) { $error .= '<p class="error">Please put the email</p>'; }
			if (empty($pass)) { $error .= '<p class="error">Please put the pass</p>'; }
			if (empty($con_pass)) { $error .= '<p class="error">Please put the confirm password</p>'; }
			
			if ($pass != $con_pass) { $error .= '<p class="error">Both password doesnot match</p>'; }
			
			if (empty($error)) { 
			$registration = $this->db->query("UPDATE `users` SET 
														`username` = '$username', 
														`email` = '$email',  
														`password` = '$pass'
														
														WHERE `users`.`ID` = '$user_id'");

			$user_roles = $this->db->query("UPDATE `user_roles` SET 
										`roleID` = '$role'
										WHERE `user_roles`.`userID` = '$user_id'");
																
			
			if ($user_roles) {											 
				$success .= '<p class="success">Update successfully!</p>'; 
			}else { $error .= 'There are someting internal problem.'; }
			}
			
			return $error.$success;
		}
	}
	
	
	
}
?>
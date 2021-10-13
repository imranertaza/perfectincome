<?php
class user_login extends CI_model {
	public function login_user() {
		
		$email = $this->input->post("email");
		$password = md5($this->input->post("password"));
		
		$sql =  "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' AND `username` = 'admin'";
		$result = $this->db->query($sql);
		$row  = $result->row();
		if ($result->num_rows() === 1) {
			$admindata = array(
					   'user_id'  => $row->ID,
					   'logged_in' => 1
				   );
			$this->session->set_userdata($admindata);
			return 1;
		}else {
			return false;
		}
	}
	
	
	public function login_member() {
		
		$user = $this->input->post("username");
		$password = md5($this->input->post("password"));
		
		$sql_std =  "SELECT * FROM `users` WHERE `username` = '$user' AND `password` = '$password' AND `status` != 'Banded'";
		$result_std = $this->db->query($sql_std);
		$row  = $result_std->row();
		if ($result_std->num_rows() === 1) {
			
			$role_sql =  "SELECT `roleID` FROM `users`,`user_roles` WHERE `users`.`ID`=`user_roles`.`userID` AND `users`.`ID` =".$row->ID;
			$user_role = $this->db->query($role_sql);
			$role  = $user_role->row();
			//print_r($role);
			
			$newdata = array(
					   'user_id'  => $row->ID,
					   /*'u_name'  	=> $row->username,
					   'email'  	=> $row->email,
					   'balance' 	=> $row->balance,
					   'Point'     	=> $row->Point,*/
					   'role'		=> $role->roleID,
					   'm_logged_in' => 1
				   );
			$this->session->set_userdata($newdata);
			return 1;
		}else {
			return false;
		}
		
		
	}
	
}
?>
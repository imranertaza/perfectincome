<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Users;
use CodeIgniter\Model;

class UserLoginModel extends Model {

    function loginMe($email, $password)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('BaseTbl.ID,BaseTbl.email, BaseTbl.password, BaseTbl.username' );
        $builder->from('users as BaseTbl');
        $builder->where('BaseTbl.email', $email);
        $builder->where('BaseTbl.username', 'admin');
        $query = $builder->get();

        $user = $query->getRow();

        if(!empty($user)){

            if(md5($password) == $user->password){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function memberLogin($username, $password){

        $db = \Config\Database::connect();
        $new_session = \Config\Services::session();
        $pass = md5($password);
        $builder = $db->table('users');
        $builder->where('username', $username)->where('password', $pass);


        $query = $builder->get();
        $user = $query->getRow();

        $users = $db->table('users');
        $users->where('username', $username)->where('password', $pass);
        $numRow = $users->countAllResults();


        if($numRow === 1){
            $user_roles = DB()->table('user_roles');
            $sql = $user_roles->where('userID',$user->ID)->get();
            $rolRow = $sql->getRow();

            $sessionArray = array(
                'user_id' => $user->ID,
                'role' => $rolRow->roleID,
                'username' => $user->username,
                'isLoggedInClient' => TRUE
            );
            $new_session->set($sessionArray);

            return TRUE;
        }else{
            return FALSE;
        }
    }
	
}
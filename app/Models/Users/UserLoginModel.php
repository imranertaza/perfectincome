<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Users;

use CodeIgniter\Model;

class UserLoginModel extends Model
{

    function loginMe($email, $password)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('BaseTbl.ID,BaseTbl.email, BaseTbl.password, BaseTbl.username');
        $builder->from('users as BaseTbl');
        $builder->where('BaseTbl.email', $email);
        $builder->where('BaseTbl.username', 'admin');
        $query = $builder->get();

        $user = $query->getRow();

        if (!empty($user)) {

            if (md5($password) == $user->password) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function memberLogin($username, $password)
    {

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


        if ($numRow === 1) {

            //login session generate
            $user_roles = DB()->table('user_roles');
            $sql = $user_roles->where('userID', $user->ID)->get();
            $rolRow = $sql->getRow();

            if ($rolRow->roleID == '6') {
                //expiry date count

                $this->check_expiry($user->ID);

                //Logout other session if logged in
                unset($_SESSION['agent_id']);
                unset($_SESSION['agentName']);
                unset($_SESSION['role_agent']);
                unset($_SESSION['isLoggedInAgent']);

                $sessionArray = array(
                    'user_id_client' => $user->ID,
                    'role_client' => $rolRow->roleID,
                    'username_client' => $user->username,
                    'isLoggedInClient' => TRUE
                );
                $new_session->set($sessionArray);
                return TRUE;
            }else {
                return FALSE;
            }


        } else {
            return FALSE;
        }
    }

    function agentLogin($username, $password)
    {

        $db = \Config\Database::connect();
        $new_session = \Config\Services::session();
        $pass = md5($password);
        $builder = $db->table('users');
        $builder->where('username', $username)->where('password', $pass)->where('status', 'Active');
        $query = $builder->get();
        $user = $query->getRow();

        $users = $db->table('users');
        $users->where('username', $username)->where('password', $pass)->where('status', 'Active');
        $numRow = $users->countAllResults();


        if ($numRow === 1) {

            //login session generate
            $user_roles = DB()->table('user_roles');
            $sql = $user_roles->where('userID', $user->ID)->get();
            $rolRow = $sql->getRow();

            if ($rolRow->roleID == '4') {

                //Logout other session if logged in
                unset($_SESSION['user_id_client']);
                unset($_SESSION['username_client']);
                unset($_SESSION['role_client']);
                unset($_SESSION['isLoggedInClient']);

                $sessionArray = array(
                    'agent_id' => $user->ID,
                    'role_agent' => $rolRow->roleID,
                    'agentName' => $user->username,
                    'isLoggedInAgent' => TRUE
                );
                $new_session->set($sessionArray);
                return TRUE;
            } else {
                return FALSE;
            }

        } else {
            return FALSE;
        }
    }

    function check_expiry($userId)
    {
        $db = \Config\Database::connect();
        $userActive = $db->table('users');
        $active = $userActive->where('ID', $userId)->get()->getRow();
        $activeDate = strtotime($active->activation_date);
        $todayDate = strtotime(date("Y-m-d"));
        $diff = $todayDate - $activeDate;
        $expiryDay = round($diff / 86400);
        $user_expiry_day = get_field_by_id_from_table("global_settings", "value", "title", "user_expiry_day");

        if ($user_expiry_day <= $expiryDay) {
            $userDactiveData = [
                'package_id' => NULL,
                'status' => 'Inactive',
            ];
            $userDactive = $db->table('users');
            $userDactive->where('ID', $userId)->update($userDactiveData);
        }
    }

}
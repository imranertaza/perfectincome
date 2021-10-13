<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'ID';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['ID', 'username', 'email', 'password', 'f_name', 'l_name', 'address1', 'address2', 'phn_no', 'nid', 'photo', 'father', 'mother', 'religion', 'blood','sex','division','district','upozila','union','post','nominee','relationship','nom_dob','bank_name','account_no','balance','OP_game_balance','commission','Point','pr_point','lpoint','rpoint','tl_left_matching','tl_right_matching','type','status','time','createdDtm','updatedBy','updatedDtm','deleted'];
    protected $useTimestamps = false;
    protected $createdField  = 'createdDtm';
    protected $updatedField  = 'updatedDtm';
    protected $deletedField  = 'deleted';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;


}
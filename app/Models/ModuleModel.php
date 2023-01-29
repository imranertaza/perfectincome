<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use App\Models\FunctionModel;
use CodeIgniter\Model;

class ModuleModel extends Model {
    protected $db;
    protected $session;
    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
    }

    public function module_list() {
        $page = DB()->table('modules')->get();
        $sql = $page->getResult();
        return $sql;
    }




}
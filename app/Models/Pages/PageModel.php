<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Pages;
use App\Models\FunctionModel;
use CodeIgniter\Model;

class PageModel extends Model {
    protected $db;
    protected $session;
    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
    }

    public function page_list() {
        $page = DB()->table('pages');
        $query = $page->where('page_type','page')->get();
        $sql = $query->getResult();

        return $sql;
    }

    public function find_template($page_id = 0) {
        $table = DB()->table('pages');
        $query =  $table->where('page_id',$page_id)->get();
        $sel_temp = $query->getRow();

        if (!empty($sel_temp)){
            $val = $sel_temp->temp;
        }else{
            $val ='';
        }

        $template = '';
        $dir = FCPATH.'../app/views/Front/template/';
        $files = scandir($dir);
        foreach($files as $key=>$file) {
            if (($file != '.') && ($file != '..')) {
                if ($val == $file) { $selected = 'selected="selected"'; }else { $selected = ''; }
                $template .= '<option  value="'.$file.'" '.$selected.'>'.$file.'</option>';
            }
        }
        return $template;
    }




}